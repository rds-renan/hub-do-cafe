@props(['title' => config('app.name', 'Hub do Café')])

    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="noindex, nofollow">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title }}</title>

        @vite(['resources/css/frontend.css'])
    </head>
    <body class="font-sans antialiased bg-white">
        <x-frontend.header />

        <main class="min-h-screen">
            {{ $slot }}
        </main>

        <x-frontend.footer />

        @vite(['resources/js/app.js'])
        @stack('scripts')
    </body>
</html>
