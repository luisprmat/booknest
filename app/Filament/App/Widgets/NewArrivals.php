<?php

namespace App\Filament\App\Widgets;

use App\Models\Book;
use Filament\Widgets\Widget;

class NewArrivals extends Widget
{
    protected string $view = 'filament.app.widgets.new-arrivals';

    protected static ?int $sort = 4;

    protected int|string|array $columnSpan = [
        'default' => 1,
        'md' => 4,
    ];

    public array $books = [];

    public function mount(): void
    {
        $this->books = Book::query()
            ->latest('created_at')
            ->take(6)
            ->get()
            ->toArray();
    }
}
