<textarea name="{{ $name }}" {{ $attributes->merge(['class' => 'p-2 bg-slate-600 rounded focus:ring-slate-200 placeholder:text-gray-400', 'id' => Str::slug($name), 'rows' => 3]) }}>{{ $value }}</textarea>

