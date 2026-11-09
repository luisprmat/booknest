<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    <div x-data="{ state: $wire.$entangle(@js($getStatePath())) }" {{ $getExtraAttributeBag() }}>
        <div class="flex w-fit flex-row-reverse gap-1">
            @for ($i = 5; $i >= 1; $i--)
                <label class="peer cursor-pointer text-slate-200 peer-hover:text-amber-400 peer-has-checked:text-amber-500 hover:scale-110 hover:text-amber-400 has-checked:text-amber-500">
                    <input class="sr-only" type="radio" x-model="state" value="{{ $i }}" />
                    <span>
                        <x-heroicon-s-star class="size-6" />
                    </span>
                </label>
            @endfor
        </div>
    </div>
</x-dynamic-component>
