<x-layout>
    <div class="p-4 bg-slate-100">
        <h1>Documenten</h1>
        @foreach ($documents as $document)
            <div>{{ $document->title }}</div>
        @endforeach

        <a href="{{ url('documents/new') }}" class="text-sky-600 hover:text-sky-700">Document toevoegen</a>
    </div>
</x-layout>