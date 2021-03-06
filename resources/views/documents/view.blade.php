<x-layout :title="$document->title">
    <h1 class="mb-4 font-bold text-4xl">{{ $document->title }}</h1>

    <div class="mb-4 p-4 bg-slate-600 text-slate-100 shadow">
        <div class="text-content">
            {!! format_markdown($document->content) !!}
        </div>
    </div>
    <a href="{{ url('documents/edit/'.$document->id) }}" class="btn">Document bewerken</a>
</x-layout>