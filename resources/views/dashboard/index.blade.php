<x-layout :title="$title">
    <h1 class="mb-4 font-bold text-4xl">Documenten</h1>
    <div class="grid grid-cols-5 gap-4 mb-4">
        @foreach ($documents as $document)
            <a href="{{ url('documents/view/'.$document->id) }}" class="block p-4 bg-slate-600 text-center shadow hover:shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="inline-block h-24 w-24 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <div class="mt-1  text-slate-100">
                    {{ $document->title }}
                </div>
            </a>
        @endforeach
    </div>
    <a href="{{ url('documents/new') }}" class="btn">Document toevoegen</a>
</x-layout>