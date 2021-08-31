<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="/static/main.css">
    <x-alpine/>
    @include('partials.cookies-alert')
</head>
<body>
    <x-static.navbar/>
    {{ $slot }}
    <x-static.footer/>
</body>
</html>