<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">

@vite(['resources/css/app.css', 'resources/js/app.js'])

<title>@yield('title', 'WorkshopHub')</title>

<body class="min-h-dvh flex flex-col">
    <header class="sticky top-0 z-50">
        <div class="p-6 w-full h-16 flex items-center justify-start bg-secondary font-bold text-white">
            <a href="{{ route('workshops.index') }}">
                WorkshopHub
            </a>
        </div>
    </header>
    <main class="p-12 flex-1 w-full bg-primary">
        @yield('content')
    </main>
</body>

</html>
