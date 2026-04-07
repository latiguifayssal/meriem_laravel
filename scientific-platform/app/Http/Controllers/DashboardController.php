<?php

namespace App\Http\Controllers;

use App\Enums\DocumentStatus;
use App\Enums\UserRole;
use App\Models\Document;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $user = auth()->user();

        $statPrimary = 0;
        $statPrimaryLabel = '';
        $statPrimaryHint = '';
        $statMid = 0;
        $statMidLabel = '';
        $statWide = 0;
        $statWideLabel = '';

        if ($user->isAdmin()) {
            $statPrimary = Document::query()->count();
            $statPrimaryLabel = __('Active manuscripts');
            $statPrimaryHint = $this->monthGrowthHint(Document::class);
            $statMid = Document::query()->whereIn('status', [DocumentStatus::Pending, DocumentStatus::UnderReview])->count();
            $statMidLabel = __('Awaiting review');
            $statWide = Document::query()->whereNotNull('published_at')->count();
            $statWideLabel = __('Published papers');
        } elseif ($user->isAuthor()) {
            $q = $user->documents();
            $statPrimary = (clone $q)->count();
            $statPrimaryLabel = __('Your manuscripts');
            $statPrimaryHint = '';
            $statMid = (clone $q)->where('status', DocumentStatus::UnderReview)->count();
            $statMidLabel = __('Under review');
            $statWide = (clone $q)->where('status', DocumentStatus::Accepted)->count();
            $statWideLabel = __('Accepted');
        } else {
            $assigned = $user->reviewedDocuments();
            $statPrimary = (clone $assigned)->count();
            $statPrimaryLabel = __('Assignments');
            $statPrimaryHint = '';
            $awaiting = (clone $assigned)->get()->filter(function (Document $doc) use ($user) {
                return ! $doc->reviews()->where('reviewer_id', $user->id)->exists();
            })->count();
            $statMid = $awaiting;
            $statMidLabel = __('Awaiting your review');
            $statWide = $user->reviews()->count();
            $statWideLabel = __('Reviews submitted');
        }

        $recentDocuments = $this->recentDocumentsForUser($user);
        $directoryUsers = $this->directoryForUser($user);

        return view('dashboard', compact(
            'statPrimary',
            'statPrimaryLabel',
            'statPrimaryHint',
            'statMid',
            'statMidLabel',
            'statWide',
            'statWideLabel',
            'recentDocuments',
            'directoryUsers',
        ));
    }

    private function monthGrowthHint(string $modelClass): string
    {
        $now = now();
        $thisMonth = $modelClass::query()->whereBetween('created_at', [$now->copy()->startOfMonth(), $now->copy()->endOfMonth()])->count();
        $prev = $now->copy()->subMonth();
        $lastMonth = $modelClass::query()->whereBetween('created_at', [$prev->copy()->startOfMonth(), $prev->copy()->endOfMonth()])->count();
        if ($lastMonth === 0) {
            return $thisMonth > 0 ? __('New this month') : '';
        }
        $pct = (int) round((($thisMonth - $lastMonth) / $lastMonth) * 100);
        if ($pct === 0) {
            return __('Stable vs last month');
        }

        return ($pct > 0 ? '+' : '').$pct.'% '.__('vs last month');
    }

    /**
     * @return Collection<int, Document>
     */
    private function recentDocumentsForUser(User $user)
    {
        if ($user->isAdmin()) {
            return Document::query()->with('user')->latest()->limit(5)->get();
        }
        if ($user->isAuthor()) {
            return $user->documents()->with('user')->latest()->limit(5)->get();
        }

        return Document::query()
            ->whereHas('reviewers', fn ($q) => $q->where('users.id', $user->id))
            ->with('user')
            ->latest()
            ->limit(5)
            ->get();
    }

    /**
     * @return Collection<int, User>
     */
    private function directoryForUser(User $user)
    {
        if ($user->isAdmin()) {
            return User::query()
                ->where('role', UserRole::Reviewer)
                ->withCount('reviews')
                ->orderByDesc('reviews_count')
                ->limit(5)
                ->get();
        }
        if ($user->isReviewer()) {
            return User::query()
                ->where('role', UserRole::Reviewer)
                ->where('id', '!=', $user->id)
                ->withCount('reviews')
                ->inRandomOrder()
                ->limit(5)
                ->get();
        }

        $ids = Document::query()
            ->where('user_id', $user->id)
            ->with('reviewers')
            ->get()
            ->flatMap(fn (Document $d) => $d->reviewers->pluck('id'))
            ->unique()
            ->filter()
            ->values();

        if ($ids->isEmpty()) {
            return collect();
        }

        return User::query()
            ->whereIn('id', $ids)
            ->withCount('reviews')
            ->limit(5)
            ->get();
    }
}
