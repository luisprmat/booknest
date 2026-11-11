<?php

namespace App\Filament\App\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class ReadingStats extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected int|string|array $columnSpan = [
        'default' => 1,
        'md' => 6,
    ];

    protected function getStats(): array
    {
        /** @var User $user */
        $user = Auth::user();

        return [
            Stat::make(__('Reading since'), (int) $user->created_at->diffInDays(now()))
                ->description(__('Days since you joined'))
                ->descriptionIcon('tabler-calendar')
                ->color('primary')
                ->extraAttributes([
                    'class' => 'h-full',
                ]),
            Stat::make(__('Books read'), $user->books()->where('status', 'returned')->count())
                ->description(__('Total books till date'))
                ->descriptionIcon('tabler-book')
                ->color('primary')
                ->extraAttributes([
                    'class' => 'h-full',
                ]),
            Stat::make(__('Reading rate'), function () use ($user) {
                $monthsSinceJoining = $user->created_at->diffInDays(now()) / 30;
                $booksRead = $user->books()->where('status', 'returned')->count();
                if ($monthsSinceJoining === 0) {
                    return 0;
                }

                return round($booksRead / $monthsSinceJoining);
            })
                ->description(__('Average books per month'))
                ->descriptionIcon('tabler-chart-line')
                ->color('primary')
                ->extraAttributes([
                    'class' => 'h-full',
                ]),
        ];
    }
}
