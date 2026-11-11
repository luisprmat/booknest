<?php

namespace App\Filament\App\Widgets;

use App\Models\User;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;

class CurrentlyReading extends Widget
{
    protected string $view = 'filament.app.widgets.currently-reading';

    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = [
        'default' => 1,
        'md' => 3,
    ];

    public array $books = [];

    public function mount(): void
    {
        /** @var User $user */
        $user = Auth::user();

        $this->books = $user->books()
            ->where('status', 'borrowed')
            ->get()
            ->toArray();
    }
}
