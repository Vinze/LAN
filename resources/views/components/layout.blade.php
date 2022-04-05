<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-slate-200 text-gray-700">
    <header class="h-16 shadow-lg bg-slate-600">
        <div class="flex container max-w-7xl mx-auto p-2 justify-between items-center">
            <div>
                <a href="#"><img src="{{ asset('images/logo.svg') }}" alt="Logo" width="150" height="49"></a>
            </div>
            <div class="flex gap-4">
                <a href="#" class="px-3 py-1 text-white rounded bg-slate-500">Home</a>
                <a href="#" class="px-3 py-1 text-white rounded bg-slate-500">Wiki</a>
                <a href="#" class="px-3 py-1 text-white rounded bg-slate-500">Snack</a>
            </div>
        </div>
    </header>
    <main>
        <div class="container max-w-7xl mx-auto px-2 pt-6">
            {{ $slot }}
        </div>
    </main>
</body>
</html>
