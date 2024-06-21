<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
        <link rel="stylesheet" href="{{ asset('vendor/css/all.min.css') }}" defer="defer">
        <link type="text/css" rel="stylesheet" media="all" href="{{ asset('css/main.css') }}">
        <title>MedSpa LeadGeneration</title>
        <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
        <style defer="defer">
            .login_header {
                background-color: #ffffff !important;
            }
        </style>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body>
        {{-- <header class="sticky-top d-flex justify-content-center align-items-center login_header bg-white px-4"> --}}
            {{-- <img class="mr-2 rounded" src="http://127.0.0.1:8002/img/worksuite-logo.png" alt="Logo" /> --}}
            {{-- <h3 class="mb-0 pl-1">Forever Medspa</h3> --}}
        {{-- </header> --}}
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
    </body>
</html>
