<?php

namespace App\Actions;

use App\Enums\DocumentStatus;
use App\Enums\ReviewStatus;
use App\Models\Document;
use App\Models\Review;

final class SyncDocumentStatusFromReviews
{
    public static function run(Document $document): void
    {
        $document->refresh();

        if ($document->published_at !== null || $document->status === DocumentStatus::Published) {
            return;
        }

        $reviewerIds = $document->reviewers()->pluck('id');

        if ($reviewerIds->isEmpty()) {
            return;
        }

        $latestStatuses = [];
        foreach ($reviewerIds as $reviewerId) {
            $latest = Review::query()
                ->where('document_id', $document->id)
                ->where('reviewer_id', $reviewerId)
                ->latest()
                ->first();

            $latestStatuses[] = $latest?->status;
        }

        foreach ($latestStatuses as $status) {
            if ($status === ReviewStatus::Rejected) {
                self::setStatusIfNeeded($document, DocumentStatus::Rejected);

                return;
            }
        }

        foreach ($latestStatuses as $status) {
            if ($status === null || $status === ReviewStatus::NeedsChanges) {
                self::setStatusIfNeeded($document, DocumentStatus::UnderReview);

                return;
            }
        }

        self::setStatusIfNeeded($document, DocumentStatus::Accepted);
    }

    private static function setStatusIfNeeded(Document $document, DocumentStatus $status): void
    {
        $document->refresh();

        if ($document->status !== $status) {
            $document->update(['status' => $status]);
        }
    }
}
