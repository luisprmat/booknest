<div class="flex flex-col space-y-0.5">
    <p class="text-lg font-semibold">{{ $getRecord()->title }}</p>
    <p class="text-primary-600 text-sm font-medium">
        <span class="inline-block pr-0.5 text-slate-600 italic">{{ __('by') }}</span>
        {{ $getRecord()->author }}
    </p>
</div>
