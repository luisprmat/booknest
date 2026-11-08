<?php

namespace App\Filament\Admin\Resources\Books\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BookForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label(__('Title'))
                    ->required(),
                TextInput::make('author')
                    ->label(__('Author'))
                    ->required(),
                FileUpload::make('image')
                    ->label(__('Image'))
                    ->image(),
                Textarea::make('description')
                    ->label(__('Description'))
                    ->columnSpanFull(),
            ]);
    }
}
