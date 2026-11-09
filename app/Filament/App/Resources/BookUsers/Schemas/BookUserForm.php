<?php

namespace App\Filament\App\Resources\BookUsers\Schemas;

use App\Enums\BookStatus;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BookUserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('book_id')
                    ->label(__('Book'))
                    ->relationship('book', 'title')
                    ->required(),
                Select::make('user_id')
                    ->label(__('User'))
                    ->relationship('user', 'name')
                    ->required(),
                Select::make('status')
                    ->label(__('Status'))
                    ->options(BookStatus::class)
                    ->required(),
                TextInput::make('rating')
                    ->label(__('Rating'))
                    ->numeric(),
                Textarea::make('review')
                    ->label(__('Review'))
                    ->columnSpanFull(),
                DateTimePicker::make('requested_at')
                    ->label(__('Requested at')),
                DateTimePicker::make('borrowed_at')
                    ->label(__('Borrowed at')),
                DateTimePicker::make('returned_at')
                    ->label(__('Returned at')),
                DateTimePicker::make('return_requested_at')
                    ->label(__('Return requested at')),
            ]);
    }
}
