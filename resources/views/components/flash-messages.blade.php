@if (isset($errors) && $errors->any())
    <x-flash-message type="error">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </x-flash-message>
@endif

@if (isset($notices) && count($notices) > 0)
    @foreach ($notices as $notice)
        <x-flash-message type="notice">{{ $notice }}</x-flash-message>
    @endforeach
@endif

@if (Session::has('success'))
    <x-flash-message type="success">{{ Session::get('success') }}</x-flash-message>
@endif

@if (Session::has('error'))
    <x-flash-message type="error">{{ Session::get('error') }}</x-flash-message>
@endif

@if (Session::has('notice'))
    <x-flash-message type="notice">{{ Session::get('notice') }}</x-flash-message>
@endif
