

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

        <!-- Scripts -->

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased bg-base-100">
<div class="min-h-screen">
            <!-- Header -->
            @include('layouts.header')

            <!-- Sidebar and Main Content -->
            <div class="drawer lg:drawer-open">
            <input id="main-drawer" type="checkbox" class="drawer-toggle" />
            <div class="drawer-content flex flex-col bg-gray-100 min-h-screen">
                <main class="p-6">
                    {{ $slot }}
                </main>
            </div>
         @include('layouts.sidebar')
        </div>
        </div>
    @livewireScripts
</body>
</html>