<?php

namespace App\Filament\App\Resources\BookUsers\Tables;

use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\TextSize;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BookUsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Split::make([
                    ImageColumn::make('book.image')
                        ->label(__('Image'))
                        ->imageWidth(80)
                        ->imageHeight('auto')
                        ->grow(false),
                    Stack::make([
                        TextColumn::make('book.title')
                            ->label(__('Title'))
                            ->size(TextSize::Large)
                            ->weight(FontWeight::SemiBold)
                            ->searchable(),
                        TextColumn::make('book.author')
                            ->label(__('Author'))
                            ->color('primary')
                            ->searchable(),
                    ])->space(1),
                    // View::make('filament.app.resources.books.book-info'),
                ]),
            ])->contentGrid([
                'default' => 1,
                'md' => 2,
                'xl' => 3,
            ])->emptyStateHeading(function (ListRecords $livewire) {
                return match ($livewire->activeTab) {
                    'requested' => __('You have not requested any books yet.'),
                    'borrowed' => __('You have not borrowed any books yet.'),
                    'returned' => __('You have not returned any books yet.'),
                    default => __('No books found.'),
                };
            })->emptyStateIcon(Heroicon::OutlinedBookOpen)
            ->searchPlaceholder(__('Search by title or author'))
            ->paginated([10]);
    }
}
