<textarea name="{{ $name }}" {{ $attributes->merge(['class' => 'p-2 bg-gray-50 rounded border border-gray-300 focus:border-blue-300 focus:ring-blue-200 placeholder:text-gray-400', 'id' => Str::slug($name), 'rows' => 3]) }}>{{ $value }}</textarea>

