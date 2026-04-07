<?php

namespace App\Enums;

enum ReviewStatus: string
{
    case Approved = 'approved';
    case NeedsChanges = 'needs_changes';
    case Rejected = 'rejected';
}
