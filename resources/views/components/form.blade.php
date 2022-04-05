<form action="{{ $action }}" method="{{ $method }}" {{ $attributes }} {{ $files ? 'enctype=multipart/form-data' : '' }}>
    @if ($method != 'GET')
        @csrf
    @endif
    {{ $slot }}
</form>