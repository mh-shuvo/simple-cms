<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="path" content="{{route('welcome')}}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-2">
                <div id="alertDiv" class="p-3 h-15 flex justify-between rounded text-gray-900 text-white {{session()->has('success') ? "bg-green-500": (session()->has('error') ? "bg-red-500":"hidden")}}">
                    <p>
                        {{session()->has('success') ? session()->get('success'): (session()->has('error') ? session()->get('error'):"")}}
                    </p>
                    <p>
                        <button id="alert-close">
                            Close
                        </button>
                    </p>
                </div>
            </div>

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
