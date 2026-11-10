<x-dynamic-component :component="$getEntryWrapperView()" :entry="$entry">
    <div {{ $getExtraAttributeBag() }}>
        <div class="flex items-center">
            @if ($getState())
                @php $state = round($getState()); @endphp
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= $state)
                        <x-heroicon-s-star class="size-3.5 text-amber-500" />
                    @else
                        <x-heroicon-o-star class="size-3.5 text-amber-500" />
                    @endif
                @endfor
            @else
                <span class="text-xs text-zinc-400 italic">{{ __('No rating') }}</span>
            @endif
        </div>
    </div>
</x-dynamic-component>
