<?php

namespace App\Http\Requests;

use App\Enums\ReviewStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        $document = $this->route('document');

        return $document && ($this->user()?->can('viewAsReviewer', $document) ?? false);
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'comment' => ['required', 'string'],
            'status' => ['required', 'string', Rule::enum(ReviewStatus::class)],
        ];
    }
}
