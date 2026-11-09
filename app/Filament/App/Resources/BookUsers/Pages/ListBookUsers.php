<?php

namespace App\Filament\App\Resources\BookUsers\Pages;

use App\Filament\App\Resources\BookUsers\BookUserResource;
use App\Models\User;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Support\Icons\Heroicon;
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
            'requested' => Tab::make(__('Requested'))
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'requested'))
                ->icon(Heroicon::OutlinedClock)
                ->badge(
                    fn () => $user->books()->where('status', 'requested')->count()
                ),
            'borrowed' => Tab::make(__('Borrowed'))
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'borrowed'))
                ->icon(Heroicon::OutlinedBookOpen)
                ->badge(
                    fn () => $user->books()->where('status', 'borrowed')->count()
                ),
            'returned' => Tab::make(__('Returned'))
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'returned'))
                ->icon(Heroicon::OutlinedCheckCircle)
                ->badge(
                    fn () => $user->books()->where('status', 'returned')->count()
                ),
        ];
    }
}
