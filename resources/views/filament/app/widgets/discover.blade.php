@use('App\Filament\App\Resources\Books\BookResource')
<x-filament-widgets::widget>
    <x-filament::section class="h-full">
        <h3 class="text-lg font-semibold">{{ __('Discover a new book') }}</h3>
        <div class="mt-3 flex items-center gap-3">
            <div class="w-16 shrink-0">
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
            </div>

            <div class="space-y-1">
                <p class="text-base/snug font-medium">{{ $book['title'] }}</p>
                <p class="text-primary-600 text-xs font-medium">{{ $book->author }}</p>
            </div>
        </div>
        <div class="mt-3 line-clamp-6 text-sm text-slate-700">{{ $book->description }}</div>
        <div class="mt-2">
            <a
                href="{{ BookResource::getUrl('view', ['record' => $book['id']]) ?? '#' }}"
                class="text-primary-600 text-sm font-medium hover:underline"
            >
                {{ __('Read more') }} →
            </a>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
