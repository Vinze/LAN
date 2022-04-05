<label {{ $attributes->merge(['class' => 'cursor-pointer']) }}>
    <input type="checkbox" name="{{ $name }}" value="{{ $value }}" class="{{ $label || $slot->isNotEmpty() ? 'mr-1' : 'mr-0' }} border border-gray-300 bg-gray-50 cursor-pointer rounded text-orange-600 focus:ring-blue-200" {{ in_array($value, $selected) ? 'checked' : '' }}>
    {{ $label ? $label : $slot }}
</label>

