<?php

namespace App\Filament\App\Resources\Books\Tables;

use App\Enums\BookStatus;
use App\Filament\App\Resources\BookUsers\BookUserResource;
use App\Filament\Tables\Columns\RatingColumn;
use App\Models\BookUser;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\Size;
use Filament\Support\Enums\TextSize;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BooksTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Split::make([
                    Stack::make([
                        Stack::make([
                            TextColumn::make('title')
                                ->label(__('Title'))
                                ->size(TextSize::Large)
                                ->weight(FontWeight::SemiBold)
                                ->searchable(),
                            TextColumn::make('author')
                                ->label(__('Author'))
                                ->color('primary')
                                ->searchable(),
                        ]),
                        RatingColumn::make('average_rating'),
                        TextColumn::make('status')
                            ->state(fn (Model $record) => $record?->currentBorrow?->status)
                            ->formatStateUsing(fn (?BookStatus $state) => $state ? $state->getBadgeLabel() : null)
                            ->badge(),
                    ])->space(3),
                    ImageColumn::make('image')
                        ->label(__('Image'))
                        ->imageWidth(80)
                        ->imageHeight('auto')
                        ->grow(false),
                ]),
            ])->contentGrid([
                'default' => 1,
                'md' => 2,
                'xl' => 3,
            ])
            ->recordActions([
                Action::make('request')
                    ->label(__('Request book'))
                    ->button()
                    ->outlined()
                    ->size(Size::ExtraSmall)
                    ->icon(Heroicon::OutlinedClock)
                    ->action(function (Model $record) {
                        BookUser::updateOrCreate(
                            [
                                'user_id' => Auth::id(),
                                'book_id' => $record->id,
                            ],
                            [
                                'status' => BookStatus::Requested,
                                'requested_at' => now(),
                            ]
                        );
                    })
                    ->after(fn (Component $livewire) => $livewire->dispatch('refresh-sidebar'))
                    ->successNotification(
                        Notification::make()
                            ->title(__('Book Requested'))
                            ->actions([
                                Action::make('view_requests')
                                    ->label(__('View all requests'))
                                    ->url(BookUserResource::getUrl())
                                    ->button()
                                    ->size(Size::ExtraSmall),
                            ])
                            ->persistent()
                    )
                    ->failureNotification(
                        Notification::make()
                            ->title(__('Failed to request book. Try again later.'))
                    )
                    ->visible(fn (Model $record) => ! in_array($record?->currentBorrow?->status, [BookStatus::Requested, BookStatus::Borrowed])),
            ])
            ->searchPlaceholder(__('Search by title or author'))
            ->paginated([12]);
    }
}
