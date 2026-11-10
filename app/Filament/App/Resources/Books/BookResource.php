<?php

namespace App\Filament\App\Resources\Books;

use App\Filament\App\Resources\Books\Pages\CreateBook;
use App\Filament\App\Resources\Books\Pages\EditBook;
use App\Filament\App\Resources\Books\Pages\ListBooks;
use App\Filament\App\Resources\Books\Pages\ViewBook;
use App\Filament\App\Resources\Books\Schemas\BookForm;
use App\Filament\App\Resources\Books\Schemas\BookInfolist;
use App\Filament\App\Resources\Books\Tables\BooksTable;
use App\Models\Book;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Override;

class BookResource extends Resource
{
    protected static ?string $model = Book::class;

    protected static ?string $slug = 'catalog';

    protected static ?int $navigationSort = 1;

    protected static string|BackedEnum|null $navigationIcon = 'tabler-books';

    protected static ?string $recordTitleAttribute = 'title';

    #[Override]
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withAvg('users as average_rating', 'book_user.rating')
            ->with('currentBorrow');
    }

    public static function getModelLabel(): string
    {
        return __('catalog');
    }

    public static function getPluralModelLabel(): string
    {
        return __('catalog');
    }

    public static function form(Schema $schema): Schema
    {
        return BookForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return BookInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BooksTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBooks::route('/'),
            'create' => CreateBook::route('/create'),
            'view' => ViewBook::route('/{record}'),
            'edit' => EditBook::route('/{record}/edit'),
        ];
    }
}
