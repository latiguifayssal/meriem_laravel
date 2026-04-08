<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DocumentFileController extends Controller
{
    public function show(Request $request, Document $document): StreamedResponse|RedirectResponse
    {
        if (! $document->file_path || ! Storage::disk('public')->exists($document->file_path)) {
            abort(404);
        }

        if (! $this->allowsAccess($request, $document)) {
            if (! $request->user()) {
                return redirect()->guest(route('login'));
            }

            abort(403);
        }

        return Storage::disk('public')->response(
            $document->file_path,
            basename($document->file_path),
            ['Content-Disposition' => 'inline; filename="'.basename($document->file_path).'"'],
        );
    }

    private function allowsAccess(Request $request, Document $document): bool
    {
        if ($document->published_at !== null) {
            return true;
        }

        $user = $request->user();
        if (! $user) {
            return false;
        }

        if ($user->isAdmin()) {
            return true;
        }

        if ($user->isAuthor() && $document->user_id === $user->id) {
            return true;
        }

        if ($user->isReviewer()) {
            return $user->reviewedDocuments()->where('documents.id', $document->id)->exists();
        }

        return false;
    }
}
