<?php

namespace App\Filament\App\Widgets;

use App\Models\User;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;

class ProgressIndicator extends Widget
{
    protected static ?int $sort = 2;

    protected int|string|array $columnSpan = [
        'default' => 1,
        'md' => 3,
    ];

    protected string $view = 'filament.app.widgets.progress-indicator';

    public int $booksRead = 0;

    public int $target = 10;

    public int $progress = 0;

    public function mount(): void
    {
        /** @var User $user */
        $user = Auth::user();

        $this->booksRead = $user->books()->where('status', 'returned')->count();
        $this->progress = min(100, ($this->booksRead / $this->target) * 100);
    }
}
