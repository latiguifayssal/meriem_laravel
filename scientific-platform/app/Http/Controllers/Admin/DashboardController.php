<?php

namespace App\Http\Controllers\Admin;

use App\Enums\DocumentStatus;
use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalDocuments = Document::query()->count();

        $pendingReviews = Document::query()
            ->whereIn('status', [
                DocumentStatus::Pending,
                DocumentStatus::UnderReview,
            ])
            ->count();

        $acceptedCount = Document::query()
            ->where('status', DocumentStatus::Accepted)
            ->count();

        $rejectedCount = Document::query()
            ->where('status', DocumentStatus::Rejected)
            ->count();

        $documents = Document::query()
            ->with('user')
            ->latest()
            ->paginate(10, ['*'], 'documents_page');

        $users = User::query()
            ->latest()
            ->paginate(10, ['*'], 'users_page');

        return view('admin.dashboard', compact(
            'totalDocuments',
            'pendingReviews',
            'acceptedCount',
            'rejectedCount',
            'documents',
            'users',
        ));
    }
}
