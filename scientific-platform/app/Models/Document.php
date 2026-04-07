<?php

namespace App\Models;

use App\Enums\DocumentStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Document extends Model
{
    /**
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'abstract',
        'file_path',
        'status',
        'user_id',
        'published_at',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'status' => DocumentStatus::class,
            'published_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function reviewers(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'document_reviewer',
            'document_id',
            'reviewer_id'
        );
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }
}
