<x-layout>
    <div class="p-4 bg-slate-100">
        <h1>Documenten</h1>
        @foreach ($documents as $document)
            <div>{{ $document->title }}</div>
        @endforeach

        <x-flash-message type="error">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum sint tempore quam accusantium dignissimos unde est suscipit quos doloribus. Amet eaque, fuga cum molestiae nam molestias veniam facilis modi ratione.</x-flash-message>


        <x-flash-message type="info">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum sint tempore quam accusantium dignissimos unde est suscipit quos doloribus. Amet eaque, fuga cum molestiae nam molestias veniam facilis modi ratione.</x-flash-message>


        <x-flash-message type="notice">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum sint tempore quam accusantium dignissimos unde est suscipit quos doloribus. Amet eaque, fuga cum molestiae nam molestias veniam facilis modi ratione.</x-flash-message>


        <x-flash-message type="success">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorum sint tempore quam accusantium dignissimos unde est suscipit quos doloribus. Amet eaque, fuga cum molestiae nam molestias veniam facilis modi ratione.</x-flash-message>

        <a href="{{ url('documents/new') }}" class="text-sky-600 hover:text-sky-700">Document toevoegen</a>
    </div>
</x-layout>