<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&family=Playball&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased ">
        <div class="min-h-screen bg-gray-500">
            @include('layouts.navigation')

            @if(session('success'))
                <div class='alert fixed top-5 border-2 border-white bg-green-500 rounded text-white p-6 z-50' style="left:50%; transform: translateX(-50%)">
                    <h1 class='text-white text-xl'>{{ session('success') }}</h1>
                    <button type="button" onclick="document.querySelector('.alert').style.visibility='hidden'" class='absolute top-0 right-3 font-bold text-white text-xl hover:text-gray-800'>x</button>
                </div>
            @endif

            <!-- Page Content -->
            <main class="mt-9 ">
                {{ $slot }}
            </main>
        </div>
        @yield('page-script')
    </body>
</html>
