<?php

namespace App\Http\Controllers\Admin;

use App\Enums\DocumentStatus;
use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DocumentController extends Controller
{
    public function index(Request $request): View
    {
        $q = $request->query('q');
        $documents = Document::query()
            ->with(['user', 'reviewers'])
            ->when($q, fn ($builder) => $builder->where('title', 'like', '%'.$q.'%'))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.documents.index', compact('documents'));
    }

    public function show(Document $document): View
    {
        $document->load(['user', 'reviewers']);
        $reviewers = User::query()
            ->where('role', UserRole::Reviewer)
            ->orderBy('name')
            ->get();

        return view('admin.documents.show', compact('document', 'reviewers'));
    }

    public function syncReviewers(Request $request, Document $document): RedirectResponse
    {
        $validated = $request->validate([
            'reviewer_ids' => ['nullable', 'array'],
            'reviewer_ids.*' => ['integer', 'exists:users,id'],
        ]);

        $ids = User::query()
            ->where('role', UserRole::Reviewer)
            ->whereIn('id', $validated['reviewer_ids'] ?? [])
            ->pluck('id')
            ->all();

        $document->reviewers()->sync($ids);

        return redirect()
            ->route('admin.documents.show', $document)
            ->with('status', 'reviewers-updated');
    }

    public function publish(Document $document): RedirectResponse
    {
        if ($document->status !== DocumentStatus::Accepted) {
            return redirect()
                ->route('admin.documents.show', $document)
                ->with('status', 'publish-not-accepted');
        }

        if ($document->published_at !== null) {
            return redirect()
                ->route('admin.documents.show', $document)
                ->with('status', 'publish-already');
        }

        $document->update([
            'published_at' => now(),
            'status' => DocumentStatus::Published,
        ]);

        return redirect()
            ->route('admin.documents.show', $document)
            ->with('status', 'published');
    }
}
