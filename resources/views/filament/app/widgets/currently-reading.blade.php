<x-filament-widgets::widget>
    <x-filament::section class="h-full">
        <h2 class="text-lg font-semibold">{{ __('Currently Reading') }}</h2>
        <div class="mt-3 grid grid-cols-1 gap-4 sm:grid-cols-[repeat(auto-fit,minmax(12rem,1fr))]">
            @forelse ($books as $book)
                <div class="flex items-center gap-3">
                    <div class="aspect-2/3 w-16 shrink-0">
                        @if ($book['image'])
                            <img
                                src="{{ Storage::url($book['image']) }}"
                                alt="{{ $book['title'] }}"
                                class="w-full rounded-sm object-cover"
                            />
                        @else
                            <div class="flex w-full shrink-0 items-center justify-center rounded-sm bg-slate-200 p-2 text-center text-sm text-gray-400">
                                {{ __('No cover') }}
                            </div>
                        @endif
                    </div>

                    <div class="flex-1 space-y-1">
                        <p class="font-medium">{{ $book['title'] }}</p>
                        <p class="text-primary-600 text-xs">{{ $book['author'] }}</p>
                    </div>
                </div>
            @empty
                <p class="text-sm text-gray-500">{{ __('You are not currently reading any books.') }}</p>
            @endforelse
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
