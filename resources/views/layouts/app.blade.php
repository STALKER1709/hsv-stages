<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'HSV Stages') — Plateforme de Stages</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="font-inter bg-slate-900 text-white antialiased">
    @include('partials.navbar')
    <main>
        @if(session('success'))
            <div x-data="{show:true}" x-show="show" x-transition class="fixed top-20 right-4 z-50 bg-emerald-500 text-white px-6 py-3 rounded-xl shadow-lg flex items-center gap-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                {{ session('success') }}
                <button @click="show=false" class="ml-2 text-white/70 hover:text-white">×</button>
            </div>
        @endif
        @if(session('error'))
            <div x-data="{show:true}" x-show="show" x-transition class="fixed top-20 right-4 z-50 bg-red-500 text-white px-6 py-3 rounded-xl shadow-lg flex items-center gap-3">
                {{ session('error') }}
                <button @click="show=false" class="ml-2">×</button>
            </div>
        @endif
        @yield('content')
    </main>
    @include('partials.footer')
    @stack('scripts')
</body>
</html>
