<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Student Management System">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title') | ICT-Information</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @yield('styles')
    </head>

    <body>
        @yield('content')

        @yield('scripts')
    </body>
</html>
