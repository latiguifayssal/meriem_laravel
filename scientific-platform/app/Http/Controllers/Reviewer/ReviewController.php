<?php

namespace App\Http\Controllers\Reviewer;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Models\Document;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;

class ReviewController extends Controller
{
    public function store(StoreReviewRequest $request, Document $document): RedirectResponse
    {
        $request->user()->reviews()->create([
            'document_id' => $document->id,
            'comment' => $request->validated('comment'),
            'status' => $request->validated('status'),
        ]);

        return redirect()
            ->route('reviewer.documents.show', $document)
            ->with('status', 'review-submitted');
    }

    public function update(UpdateReviewRequest $request, Review $review): RedirectResponse
    {
        $review->update($request->validated());

        return redirect()
            ->route('reviewer.documents.show', $review->document)
            ->with('status', 'review-updated');
    }
}
