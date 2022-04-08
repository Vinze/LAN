<x-layout :title="$title">
    <div class="p-4 bg-slate-100">
        <x-form method="POST">
            <x-form-group for="title" label="Titel" class="mb-4">
                <x-form-input name="title" :value="$document->title" class="w-full"/>
            </x-form-group>
            <x-form-group for="content" label="Inhoud" class="mb-4">
                <x-form-textarea name="content" :value="$document->content" class="w-full" rows="10"/>
            </x-form-group>
            <div class="mt-2">
                <x-form-submit class="mr-2">Opslaan</x-form-submit>
                @if ($document->exists)
                    <a href="{{ url('documents/view/'.$document->id) }}" class="link">Annuleren</a>
                @else
                    <a href="{{ url('documents') }}" class="link">Annuleren</a>
                @endif
            </div>
        </x-form>
    </div>
</x-layout>