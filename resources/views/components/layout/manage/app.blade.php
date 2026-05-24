<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'manage Panel') - Findora</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/2.png') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Livewire Styles -->
    @livewireStyles
    
</head>
<body class="bg-gray-50 text-gray-900 antialiased">
    <div x-data="{ sidebarOpen: false }" class="min-h-screen flex">
        
        <!-- Sidebar -->
        @include('layouts.manage.sidebar')
        
        <!-- Main Content -->
        <div class="flex-1 flex flex-col transition-all duration-300">
            
            <!-- Top Navbar -->
            @include('layouts.manage.navbar')
            
            <!-- Page Content -->
            <main class="flex-1 p-4 sm:p-6 lg:p-8">
                @if(isset($slot))
                    {{ $slot }}
                @else
                    @yield('content')
                @endif
            </main>
            
            <!-- Footer -->
            @include('layouts.manage.footer')
        </div>
    </div>

    @livewireScripts
</body>
</html>
