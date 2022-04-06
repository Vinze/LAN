<x-layout :title="$title">
    <h1 class="mb-6 font-bold text-3xl">{{ $title }}</h1>
    <div class="p-4 bg-slate-100">
        <x-form method="POST">
            <x-form-group for="title" label="Titel" class="mb-4">
                <x-form-input name="title" :value="$document->title" class="w-full"/>
            </x-form-group>
            <x-form-group for="content" label="Inhoud" class="mb-4">
                <x-form-textarea name="content" :value="$document->content" class="w-full" rows="10"/>
            </x-form-group>
            <div class="mt-2">
                <x-form-submit>Opslaan</x-form-submit>
            </div>
        </x-form>
    </div>
</x-layout>