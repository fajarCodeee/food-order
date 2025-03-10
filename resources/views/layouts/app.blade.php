<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('app.name') }}</title>
    <link href="{{ asset('dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/3bed663d67.js" crossorigin="anonymous"></script>
</head>

<body class="bg-body-tertiary">
    {{ $slot }}
    <script src="{{ asset('dist/js/bootstrap.min.js') }}"></script>
</body>

</html>
