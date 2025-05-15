<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Manasik') }}</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 font-sans">
    <main class="flex justify-center items-center min-h-screen px-4">
        {{ $slot }}
    </main>
</body>
</html>
