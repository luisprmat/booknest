<?php

namespace App\Filament\App\Resources\BookUsers;

use App\Filament\App\Resources\BookUsers\Pages\CreateBookUser;
use App\Filament\App\Resources\BookUsers\Pages\EditBookUser;
use App\Filament\App\Resources\BookUsers\Pages\ListBookUsers;
use App\Filament\App\Resources\BookUsers\Schemas\BookUserForm;
use App\Filament\App\Resources\BookUsers\Tables\BookUsersTable;
use App\Models\BookUser;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Override;

class BookUserResource extends Resource
{
    protected static ?string $model = BookUser::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function getModelLabel(): string
    {
        return __('book');
    }

    public static function getPluralModelLabel(): string
    {
        return __('My Bookshelf');
    }

    #[Override]
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('user_id', Auth::id());
    }

    public static function form(Schema $schema): Schema
    {
        return BookUserForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BookUsersTable::configure($table);
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
            'index' => ListBookUsers::route('/'),
            'create' => CreateBookUser::route('/create'),
            'edit' => EditBookUser::route('/{record}/edit'),
        ];
    }
}
