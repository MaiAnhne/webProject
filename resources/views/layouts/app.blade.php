<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
    <div class="min-h-screen bg-white">
        <!-- Thanh header giống Tiki -->
        <header class="bg-cyan-500 text-white p-4 flex justify-between items-center">
            <div class="text-2xl font-bold">Tiki</div>
            <input type="text" placeholder="Tìm sách..." class="w-1/3 px-3 py-2 rounded text-black" />
            <div class="space-x-4">
                <a href="#" class="hover:underline">Đăng nhập</a>
                <a href="#" class="hover:underline">Đăng ký</a>
                <a href="#" class="hover:underline">Giỏ hàng <span class="bg-yellow-400 text-black rounded px-2">2</span></a>
            </div>
        </header>

        <!-- Banner -->
        <section class="bg-blue-100 py-6">
            <div class="text-center text-xl font-semibold text-blue-800">
                🔥 SĂN DEAL GIÁ SỐC – GIẢM ĐẾN 50% 🔥
            </div>
        </section>

        <!-- Navigation bar -->
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-gray-100 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main class="p-6">
            {{ $slot }}
        </main>
    </div>
    </body>
</html>
