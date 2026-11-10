<?php

namespace App\Filament\App\Resources\BookUsers\Pages;

use App\Filament\App\Resources\BookUsers\BookUserResource;
use App\Models\User;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ListBookUsers extends ListRecords
{
    protected static string $resource = BookUserResource::class;

    public function getTabs(): array
    {
        /** @var User $user */
        $user = Auth::user();

        return [
            'requested' => Tab::make(__('Requested Books'))
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'requested'))
                ->icon('tabler-clock-plus')
                ->badge(fn () => $user->books()->where('status', 'requested')->count()),
            'borrowed' => Tab::make(__('Currently Reading'))
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'borrowed'))
                ->icon('tabler-book')
                ->badge(fn () => $user->books()->where('status', 'borrowed')->count()),
            'returned' => Tab::make(__('Past Reads'))
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'returned'))
                ->icon('tabler-book-2')
                ->badge(fn () => $user->books()->where('status', 'returned')->count()),
        ];
    }
}
