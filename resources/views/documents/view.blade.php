<x-layout :title="$document->title">
    <div class="mb-4 p-4 bg-slate-600 text-slate-100 shadow">
        {!! format_markdown($document->content) !!}
    </div>
    <a href="{{ url('documents/edit/'.$document->id) }}" class="link">Document bewerken</a>
</x-layout>