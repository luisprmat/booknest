<?php

namespace App\Filament\App\Resources\Books\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class BookInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('title')
                    ->label(__('Title')),
                TextEntry::make('author')
                    ->label(__('Author')),
                ImageEntry::make('image')
                    ->label(__('Image'))
                    ->placeholder('-'),
                TextEntry::make('description')
                    ->label(__('Description'))
                    ->placeholder('-')
                    ->columnSpanFull(),
                TextEntry::make('created_at')
                    ->label(__('Created at'))
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->label(__('Updated at'))
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
