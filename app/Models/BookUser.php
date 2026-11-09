<?php

namespace App\Models;

use App\Enums\BookRating;
use App\Enums\BookStatus;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

#[Table(incrementing: true)]
#[Fillable([
    'book_id',
    'user_id',
    'status',
    'rating',
    'review',
    'requested_at',
    'borrowed_at',
    'returned_at',
    'return_requested_at',
])]
class BookUser extends Pivot
{
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'requested_at' => 'datetime',
            'borrowed_at' => 'datetime',
            'returned_at' => 'datetime',
            'return_requested_at' => 'datetime',
            'status' => BookStatus::class,
            'rating' => BookRating::class,
        ];
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
