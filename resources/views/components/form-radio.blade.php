@if ($label)
    <label {{ $attributes->merge(['class' => 'cursor-pointer']) }}>
        <input type="radio"
            name="{{ $name }}"
            value="{{ $value }}"
            class="mr-1 cursor-pointer border border-gray-300 bg-gray-50 text-orange-600 focus:ring-blue-200"
            {{ $value === $selected ? 'checked' : '' }}
        > {{ $label }}
    </label>
@else
    <input type="radio"
        name="{{ $name }}"
        value="{{ $value }}"
        {{ $attributes->merge(['class' => 'mr-1 cursor-pointer border border-gray-300 bg-gray-50 text-orange-600 focus:ring-blue-200']) }}
        {{ $value === $selected ? 'checked' : '' }}>
@endif