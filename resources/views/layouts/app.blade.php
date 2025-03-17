<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? config('app.name') }}</title>
    <link href="{{ asset('dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/3bed663d67.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>
    {{-- <!-- @vite('resources/js/app.js') --> --}}
</head>

<body class="bg-body-tertiary">
    {{ $slot }}
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="{{ asset('dist/js/bootstrap.min.js') }}"></script>
</body>

</html>
