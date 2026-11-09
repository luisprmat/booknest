<?php

namespace App\Filament\App\Resources\BookUsers\Tables;

use App\Enums\BookRating;
use App\Enums\BookStatus;
use App\Filament\App\Resources\Books\BookResource;
use App\Models\BookUser;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
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

class BookUsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                Split::make([
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
                        TextColumn::make('updated_at')
                            ->since()
                            ->extraAttributes(['class' => 'text-xs text-gray-500']),
                        TextColumn::make('status')
                            ->state(__('Return requested'))
                            ->size(TextSize::ExtraSmall)
                            ->badge()
                            ->visible(fn (?BookUser $record) => $record?->return_requested_at && $record?->status === BookStatus::Borrowed),
                    ])->space(1),
                    ImageColumn::make('book.image')
                        ->label(__('Image'))
                        ->imageWidth(80)
                        ->imageHeight('auto')
                        ->grow(false),
                ]),
            ])
            ->contentGrid([
                'default' => 1,
                'md' => 2,
                'xl' => 3,
            ])
            ->recordActions([
                DeleteAction::make()
                    ->label(__('Cancel request'))
                    ->button()
                    ->outlined()
                    ->size(Size::ExtraSmall)
                    ->modalHeading(__('Cancel Book Request'))
                    ->modalDescription(__('Are you sure you want to cancel your request for this book?'))
                    ->modalSubmitActionLabel(__('Yes'))
                    ->modalCancelActionLabel(__('No'))
                    ->visible(fn (Model $record) => $record->status === BookStatus::Requested)
                    ->successNotificationTitle(__('Request Cancelled'))
                    ->failureNotificationTitle(__('Failed to Cancel Request. Try again later')),
                Action::make('return_book')
                    ->label(__('Return Book'))
                    ->button()
                    ->outlined()
                    ->size(Size::ExtraSmall)
                    ->icon(Heroicon::OutlinedArrowLeftCircle)
                    ->modalHeading(__('Did you like the book?'))
                    ->modalDescription(__('Your feedback helps us improve our recommendations.'))
                    ->schema([
                        Select::make('rating')
                            ->label(__('Rate the book'))
                            ->options(BookRating::class)
                            ->required(),
                        RichEditor::make('review')
                            ->label(__('Write a Review'))
                            ->placeholder(__('Share your thoughts about the book').'...')
                            ->toolbarButtons(
                                ['bold', 'italic', 'underline', 'h2', 'h3']
                            ),
                    ])
                    ->action(function (BookUser $record, array $data) {
                        $record->update([
                            'return_requested_at' => now(),
                            'rating' => $data['rating'],
                            'review' => $data['review'],
                        ]);
                    })
                    ->successNotification(
                        Notification::make('return_requested')
                            ->title(__('Request placed successfully'))
                            ->body(__('Thank you for your feedback! You will be notified when your return is processed.'))
                            ->icon(Heroicon::CheckCircle)
                    )
                    ->failureNotification(
                        Notification::make('return_failed')
                            ->title(__('Failed to request return'))
                            ->body(__('Please try again later. Or contact support if the issue persists.'))
                    )
                    ->visible(fn (BookUser $record) => $record->status === BookStatus::Borrowed && ! $record->return_requested_at),
            ])
            ->emptyStateHeading(function (ListRecords $livewire) {
                return match ($livewire->activeTab) {
                    'requested' => __('You have not requested any books yet.'),
                    'borrowed' => __('You have not borrowed any books yet.'),
                    'returned' => __('You have not returned any books yet.'),
                    default => __('No books found.'),
                };
            })
            ->emptyStateIcon(Heroicon::OutlinedBookOpen)
            ->emptyStateActions([
                Action::make('browse_books')
                    ->label(__('Browse Books'))
                    ->url(BookResource::getUrl())
                    ->button(),
            ])
            ->searchPlaceholder(__('Search by title or author'))
            ->paginated([10]);
    }
}
