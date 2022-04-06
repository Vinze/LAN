<!doctype html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="base-url" content="{{ url('/') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-slate-200 text-gray-700">
    <header class="h-16 shadow-lg bg-slate-600">
        <div class="flex container max-w-7xl mx-auto p-2 justify-between items-center">
            <div>
                <a href="#"><img src="{{ asset('images/logo.svg') }}" alt="Logo" width="150" height="49"></a>
            </div>
            <div class="flex">
                <a href="#" class="px-3 py-1 text-white rounded hover:bg-slate-500">Home</a>
                <a href="#" class="px-3 py-1 text-white rounded hover:bg-slate-500">Docs</a>
                <a href="#" class="px-3 py-1 text-white rounded hover:bg-slate-500">Snack</a>
            </div>
        </div>
    </header>
    <main>
        <div class="container max-w-7xl mx-auto px-2 pt-6">
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
