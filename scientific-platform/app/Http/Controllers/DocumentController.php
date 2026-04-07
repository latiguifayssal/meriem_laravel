<?php

namespace App\Http\Controllers;

use App\Enums\DocumentStatus;
use App\Http\Requests\StoreDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;
use App\Models\Document;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class DocumentController extends Controller
{
    public function index(Request $request): View
    {
        $this->authorize('viewAny', Document::class);

        $q = $request->query('q');
        $documents = $request->user()
            ->documents()
            ->when($q, fn ($builder) => $builder->where('title', 'like', '%'.$q.'%'))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('author.documents.index', compact('documents'));
    }

    public function create(): View
    {
        $this->authorize('create', Document::class);

        return view('author.documents.create');
    }

    public function store(StoreDocumentRequest $request): RedirectResponse
    {
        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('documents', 'public');
        }

        $request->user()->documents()->create([
            'title' => $request->validated('title'),
            'abstract' => $request->validated('abstract'),
            'file_path' => $filePath,
            'status' => DocumentStatus::Pending,
        ]);

        return redirect()->route('author.documents.index')
            ->with('status', 'document-created');
    }

    public function show(Document $document): View
    {
        $this->authorize('view', $document);

        $document->load([
            'reviews' => fn ($query) => $query->with('reviewer')->latest(),
        ]);

        return view('author.documents.show', compact('document'));
    }

    public function edit(Document $document): View
    {
        $this->authorize('update', $document);

        $document->load([
            'reviews' => fn ($query) => $query->with('reviewer')->latest(),
        ]);

        return view('author.documents.edit', compact('document'));
    }

    public function update(UpdateDocumentRequest $request, Document $document): RedirectResponse
    {
        $data = $request->safe()->only(['title', 'abstract']);

        if ($request->hasFile('file')) {
            if ($document->file_path) {
                Storage::disk('public')->delete($document->file_path);
            }
            $data['file_path'] = $request->file('file')->store('documents', 'public');
        }

        $data['status'] = DocumentStatus::UnderReview;
        $data['published_at'] = null;

        $document->update($data);

        return redirect()->route('author.documents.show', $document)
            ->with('status', 'document-updated');
    }

    public function destroy(Document $document): RedirectResponse
    {
        $this->authorize('delete', $document);

        if ($document->file_path) {
            Storage::disk('public')->delete($document->file_path);
        }

        $document->delete();

        return redirect()->route('author.documents.index')
            ->with('status', 'document-deleted');
    }
}
