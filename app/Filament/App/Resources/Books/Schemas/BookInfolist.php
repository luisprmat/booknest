<?php

namespace App\Filament\App\Resources\Books\Schemas;

use App\Enums\BookStatus;
use App\Filament\App\Resources\BookUsers\BookUserResource;
use App\Filament\Infolists\Components\Rating;
use App\Models\Book;
use App\Models\BookUser;
use Filament\Actions\Action;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Text;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Size;
use Filament\Support\Icons\Heroicon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BookInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->columns([
                        'sm' => 4,
                        'xl' => 5,
                    ])
                    ->columnSpanFull()
                    ->schema([
                        Grid::make()
                            ->columnSpan([
                                'sm' => 3,
                                'xl' => 4,
                            ])
                            ->schema([
                                TextEntry::make('title')
                                    ->hiddenLabel()
                                    ->columnSpanFull()
                                    ->extraAttributes([
                                        'class' => 'text-3xl xl:text-4xl font-bold',
                                    ]),
                                TextEntry::make('author')
                                    ->hiddenLabel()
                                    ->columnSpanFull()
                                    ->extraAttributes([
                                        'class' => 'text-primary-600 font-medium text-lg',
                                    ]),
                                TextEntry::make('description')
                                    ->hiddenLabel()
                                    ->placeholder('-')
                                    ->columnSpanFull()
                                    ->extraAttributes(['class' => 'text-base']),
                                Rating::make('average_rating')
                                    ->label(__('Rating')),
                                TextEntry::make('borrowed_count')
                                    ->label(__('Borrowed'))
                                    ->state(fn (Book $record) => trans_choice(':count time|:count times', $record->users()->count())),
                                Actions::make([
                                    Action::make('request')
                                        ->label(__('Request book'))
                                        ->button()
                                        ->icon(Heroicon::OutlinedClock)
                                        ->action(function (Model $record): void {
                                            $bookUser = BookUser::updateOrCreate(
                                                [
                                                    'user_id' => Auth::id(),
                                                    'book_id' => $record->id,
                                                ],
                                                [
                                                    'status' => BookStatus::Requested,
                                                    'requested_at' => now(),
                                                ]
                                            );

                                            $record->setRelation('currentBorrow', $bookUser);
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
                                ]),
                            ]),
                        ImageEntry::make('image')
                            ->hiddenLabel()
                            ->imageWidth('100%')
                            ->imageHeight('auto')
                            ->extraImgAttributes([
                                'class' => 'rounded-lg shadow-md',
                            ])
                            ->placeholder('-'),
                        Text::make(__('User Reviews'))
                            ->columnSpanFull()
                            ->extraAttributes([
                                'class' => 'text-xl font-semibold',
                            ]),
                        RepeatableEntry::make('reviews')
                            ->hiddenLabel()
                            ->state(fn (Book $record) => $record->reviews()->latest()->take(4)->get())
                            ->schema([
                                TextEntry::make('review')
                                    ->hiddenLabel()
                                    ->html(),
                                TextEntry::make('user.name')
                                    ->hiddenLabel()
                                    ->extraAttributes([
                                        'class' => 'italic text-sm text-primary-600',
                                    ]),
                            ])
                            ->grid([
                                'default' => 1,
                                'md' => 2,
                            ])
                            ->contained(false)
                            ->columnSpanFull(),
                    ])
                    ->dense(),
            ]);
    }
}
