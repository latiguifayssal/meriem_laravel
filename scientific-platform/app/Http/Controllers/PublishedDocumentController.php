<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\View\View;

class PublishedDocumentController extends Controller
{
    public function show(Document $document): View
    {
        abort_if($document->published_at === null, 404);

        $document->load('user');

        return view('published.show', compact('document'));
    }
}
