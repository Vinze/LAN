<select name="{{ $name }}" {{ $attributes->merge(['class' => 'p-2 align-middle bg-gray-50 rounded border-gray-300 focus:border-blue-300 focus:ring-blue-200', 'id' => Str::slug($name)]) }}>
    @if ($placeholder)
        <option value="">{{ $placeholder }}</option>
    @endif
    @foreach ($options as $value => $text)
        <option value="{{ $value }}" {{ in_array($value, $selected) ? 'selected' : '' }}>{{ $text }}</option>
    @endforeach
</select>
