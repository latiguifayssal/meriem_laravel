<?php

namespace App\Enums;

enum DocumentStatus: string
{
    case Pending = 'pending';
    case UnderReview = 'under_review';
    case Accepted = 'accepted';
    case Rejected = 'rejected';
    case Published = 'published';
}
