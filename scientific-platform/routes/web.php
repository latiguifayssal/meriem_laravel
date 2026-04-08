<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\DocumentController as AdminDocumentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DocumentFileController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublishedDocumentController;
use App\Http\Controllers\Reviewer\DocumentController as ReviewerDocumentController;
use App\Http\Controllers\Reviewer\ReviewController as ReviewerReviewController;
use App\Models\Document;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $publishedDocuments = Document::query()
        ->with('user')
        ->whereNotNull('published_at')
        ->orderByDesc('published_at')
        ->limit(12)
        ->get();

    return view('welcome', compact('publishedDocuments'));
});

Route::get('/published/{document}', [PublishedDocumentController::class, 'show'])
    ->name('published.show');

Route::get('/documents/{document}/file', [DocumentFileController::class, 'show'])
    ->name('documents.file');

Route::get('/dashboard', DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified', 'isAdmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/documents', [AdminDocumentController::class, 'index'])->name('documents.index');
    Route::get('/documents/{document}', [AdminDocumentController::class, 'show'])->name('documents.show');
    Route::patch('/documents/{document}/reviewers', [AdminDocumentController::class, 'syncReviewers'])->name('documents.reviewers.sync');
    Route::post('/documents/{document}/publish', [AdminDocumentController::class, 'publish'])->name('documents.publish');
});

Route::middleware(['auth', 'verified', 'isAuthor'])->prefix('author')->name('author.')->group(function () {
    Route::get('/dashboard', function () {
        return view('author.dashboard');
    })->name('dashboard');

    Route::resource('documents', DocumentController::class);
});

Route::middleware(['auth', 'verified', 'isReviewer'])->prefix('reviewer')->name('reviewer.')->group(function () {
    Route::get('/dashboard', function () {
        return view('reviewer.dashboard');
    })->name('dashboard');

    Route::get('/documents', [ReviewerDocumentController::class, 'index'])->name('documents.index');
    Route::get('/documents/{document}', [ReviewerDocumentController::class, 'show'])->name('documents.show');
    Route::post('/documents/{document}/reviews', [ReviewerReviewController::class, 'store'])->name('documents.reviews.store');
    Route::patch('/reviews/{review}', [ReviewerReviewController::class, 'update'])->name('reviews.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
