<x-filament-widgets::widget>
    <x-filament::section class="h-full">
        <div class="flex flex-col gap-2">
            <h2 class="text-lg font-semibold">{{ __('Reading Streak to Pro Level') }}</h2>
            <p class="text-sm text-gray-500">
                {!! trans_choice('You have read <b>:count</b> book so far.|You have read <b>:count</b> books so far.', $booksRead) !!}
            </p>

            <div class="relative h-4 w-full overflow-hidden rounded-full bg-gray-200">
                <div
                    class="from-primary-500 to-primary-600 h-full rounded-full bg-linear-to-r transition-all duration-700"
                    style="width: {{ $progress }}%;"
                ></div>
            </div>

            <div class="flex justify-between text-xs text-gray-500">
                <span>{{ __(':count books', ['count' => 0]) }}</span>
                <span>{{ __(':count books', ['count' => $target]) }}</span>
            </div>

            <p class="mt-2 text-sm">
                @if ($progress >= 100)
                    {!! __('🎉 You’ve reached <b>Pro Reader</b> level! Keep it up!') !!}
                @else
                    {!! trans_choice('Only <b>:count</b> more book to reach <b>Pro Reader</b> level!|Only <b>:count</b> more books to reach <b>Pro Reader</b> level!', $target - $booksRead) !!}
                @endif
            </p>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
