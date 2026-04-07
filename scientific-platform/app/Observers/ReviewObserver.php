<?php

namespace App\Observers;

use App\Actions\SyncDocumentStatusFromReviews;
use App\Models\Document;
use App\Models\Review;

class ReviewObserver
{
    public function saved(Review $review): void
    {
        $document = Document::query()->find($review->document_id);

        if ($document === null) {
            return;
        }

        SyncDocumentStatusFromReviews::run($document);
    }
}
