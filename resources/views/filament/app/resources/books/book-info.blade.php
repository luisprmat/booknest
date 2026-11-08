<div class="flex flex-col space-y-0.5">
    <p class="text-lg font-semibold">
        {{ $getRecord()->title }}
    </p>
    <p class="text-sm text-primary-600 font-medium">
        <span class="inline-block italic text-slate-600 pr-0.5">{{ __('by') }}</span>
        {{ $getRecord()->author }}
    </p>
</div>
