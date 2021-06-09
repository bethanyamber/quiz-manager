<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!doctype html>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Quiz Manager') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <div class="h-screen flex overflow-hidden bg-gray-100">

        @guest
            <div class="flex flex-col w-0 flex-1 overflow-hidden">
                <div class="relative z-10 flex-shrink-0 flex h-16 bg-white shadow">
                    <div class="flex items-center flex-shrink-0 px-3">
                        <div class="h-8 w-auto flex items-center text-purple-900">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <h2 class="text-lg ml-3 font-bold">Quiz Manager</h2>
                        </div>
                    </div>
                    <div class="flex-1 px-4 flex justify-end">
                        <div class="ml-4 flex items-center md:ml-6">
                            <!-- Profile dropdown -->
                            <div class="ml-3 relative" x-data="{ isOpen: false }">
                                <div class="flex">
                                    @if (Route::has('login'))
                                        <a class="mr-4 max-w-xs bg-white flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                           href="{{ route('login') }}">{{ __('Login') }}</a>
                                    @endif
                                    @if (Route::has('register'))
                                        <a class="mr-4 max-w-xs bg-white flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                           href="{{ route('register') }}">{{ __('Register') }}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <main class="flex-1 my-4 relative overflow-y-auto focus:outline-none">
                    @yield('content')
                </main>
            </div>
        @else
            @include('layouts.sidebar')
            <div class="flex flex-col w-0 flex-1 overflow-hidden">
                @include('layouts.navbar')

                <main class="flex-1 p-4 relative overflow-y-auto focus:outline-none">
                    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:max-w-7xl lg:px-8">
                        @yield('content')
                    </div>
                </main>
            </div>
        @endguest
    </div>
</div>
</body>
</html>
