<x-layout :title="$title">
    <x-form method="POST">
        <div class="mb-4">
            <x-form-input name="title" :value="$document->title" placeholder="Titel" class="w-full"/>
        </div>
        <div class="mb-4">
            <x-form-textarea name="content" :value="$document->content" placeholder="Inhoud" class="w-full" rows="10"/>
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
</x-layout>