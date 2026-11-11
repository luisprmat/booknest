@use('App\Filament\App\Resources\Books\BookResource')
@use('Carbon\Carbon')
<x-filament-widgets::widget>
    <x-filament::section class="h-full">
        <div class="space-y-3">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold">{{ __('New Arrivals') }}</h3>

                <a href="{{ BookResource::getUrl() }}" class="text-primary-600 text-sm hover:underline">
                    {{ __('View All') }} →
                </a>
            </div>

            <div class="grid grid-cols-[repeat(6,7rem)] gap-3 overflow-x-auto">
                @forelse ($books as $book)
                    <div>
                        <a
                            href="{{ BookResource::getUrl('view', ['record' => $book['id']]) ?? '#' }}"
                            class="block rounded-sm"
                        >
                            @if ($book['image'])
                                <img
                                    src="{{ Storage::url($book['image']) }}"
                                    alt="{{ $book['title'] }}"
                                    class="aspect-2/3 w-full rounded-sm object-cover"
                                />
                            @else
                                <div class="flex aspect-2/3 w-full shrink-0 items-center justify-center rounded-sm bg-slate-200 p-2 text-center text-sm text-gray-400">
                                    {{ __('No cover') }}
                                </div>
                            @endif

                            <div class="space-y-1 pt-3">
                                <p class="text-sm">{{ $book['title'] }}</p>
                                <p class="text-xs text-slate-500">
                                    {{ Carbon::parse($book['created_at'])->diffForHumans() }}
                                </p>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-span-full text-sm text-gray-500">{{ __('No new arrivals at the moment.') }}</div>
                @endforelse
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
