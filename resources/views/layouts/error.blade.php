<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Student Management System">

        <title>@yield('code') | ICT-Information</title>
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>

    <body>
        <main class="container flex items-center justify-center py-10">
            <div class="w-full md:w-1/2 xl:w-1/3">
                <div class="mx-5 md:mx-10 text-center uppercase">
                    <h1 class="text-9xl font-bold">
                        @yield('code')
                    </h1>
                    <h2 class="text-primary mt-5">
                        @yield('message')
                    </h2>
                    <h5 class="mt-2">
                        @yield('description')
                    </h5>
                    <a href="{{ url()->previous() }}" class="btn btn_primary mt-5 uppercase">
                        ย้อนกลับ
                    </a>
                </div>
            </div>
        </main>
    </body>
</html>
