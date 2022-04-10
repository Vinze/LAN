<x-layout :title="$title">
    <x-form method="POST">
        <div class="mb-2">
            <x-form-input name="title" :value="$document->title" placeholder="Titel" class="font-bold text-2xl w-full"/>
        </div>
        <div class="mb-4">
            <x-form-textarea name="content" :value="$document->content" placeholder="Inhoud" class="p-4 w-full" rows="10"/>
        </div>
        <div class="mt-4">
            <x-form-submit class="mr-2">Opslaan</x-form-submit>
            @if ($document->exists)
                <a href="{{ url('documents/view/'.$document->id) }}" class="link">Annuleren</a>
            @else
                <a href="{{ url('/') }}" class="link">Annuleren</a>
            @endif
        </div>
    </x-form>

    <x-slot:head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
    </x-slot>


    <x-slot:scripts>
        <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
        <script>
            var simplemde = new SimpleMDE({ element: document.getElementById("content") });
        </script>
    </x-slot>
</x-layout>