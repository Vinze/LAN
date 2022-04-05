<div {{ $attributes->merge(['class' => 'md:flex']) }}>
    @if (isset($label))
        <label @if (isset($for)) for="{{ Str::slug($for) }}" @endif class="block pb-1 md:flex-none md:py-2 md:w-44">
            {{ $label }}:
            @if (isset($required))
                <span class="text-red-400 font-bold text-md leading-3">*</span>
            @endif
        </label>
    @elseif (isset($text))
        <div class="block pb-1 md:pb-0 md:flex-none md:w-44">{{ $text }}:</div>
    @endif
    <div class="flex-grow">{{ $slot }}</div>
</div>