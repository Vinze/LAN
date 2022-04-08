<!doctype html>
<html lang="nl">
<head>
    <title>{{ isset($title) ? $title : 'LAN' }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="base-url" content="{{ url('/') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ mix_url('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-slate-700 text-gray-100">
    <header class="bg-slate-600 shadow">
        <div class="flex container max-w-7xl mx-auto py-4 px-2 justify-between items-center">
            <div>
                <a href="{{ url('/') }}"><img src="{{ asset('images/logo.svg') }}" alt="Logo" width="300" height="98"></a>
            </div>
            <div class="flex">
                @if (Auth::check())
                    <a href="{{ url('/') }}" class="px-3 py-1 text-lg text-white rounded hover:bg-slate-500">Home</a>
                    <a href="{{ url('logout') }}" class="px-3 py-1 text-lg text-white rounded hover:bg-slate-500">Logout</a>
                @endif
            </div>
        </div>
    </header>
    <main>
        <div class="container max-w-7xl mx-auto px-2 pt-6">
            @if (isset($title))
                <h1 class="mb-4 font-bold text-4xl">{{ $title }}</h1>
            @endif
            <x-flash-messages></x-flash-messages>
            {{ $slot }}
        </div>
    </main>

    <script src="{{ mix_url('js/app.js') }}"></script>
    <x-slot:scripts></x-slot>
    <script>
        Alpine.start();
    </script>
</body>
</html>
