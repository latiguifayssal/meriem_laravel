<?php

namespace App\Http\Controllers\Reviewer;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DocumentController extends Controller
{
    public function index(Request $request): View
    {
        $q = $request->query('q');
        $documents = $request->user()
            ->reviewedDocuments()
            ->with('user')
            ->when($q, fn ($builder) => $builder->where('title', 'like', '%'.$q.'%'))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('reviewer.documents.index', compact('documents'));
    }

    public function show(Request $request, Document $document): View
    {
        $this->authorize('viewAsReviewer', $document);

        $document->load('user');

        $myReviews = $document->reviews()
            ->where('reviewer_id', $request->user()->id)
            ->latest()
            ->get();

        return view('reviewer.documents.show', compact('document', 'myReviews'));
    }
}
