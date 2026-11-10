<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Auth;

#[Fillable(['title', 'author', 'image', 'description'])]
class Book extends Model
{
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function currentBorrow(): HasOne
    {
        return $this->hasOne(BookUser::class)
            ->where('user_id', Auth::id());
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(BookUser::class)
            ->whereNotNull('review');
    }
}
