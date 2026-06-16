<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — HSV Stages</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="font-inter bg-slate-950 text-white antialiased" x-data="{ sidebarOpen: false }">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-900 border-r border-slate-800 transform transition-transform duration-300 lg:translate-x-0 lg:static lg:inset-auto lg:flex lg:flex-col"
               :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
            <div class="flex items-center gap-3 px-6 py-5 border-b border-slate-800">
                <div class="w-10 h-10 bg-gradient-to-br from-emerald-400 to-emerald-600 rounded-xl flex items-center justify-center font-bold text-slate-900">H</div>
                <div>
                    <div class="font-bold text-white text-sm">HSV Stages</div>
                    <div class="text-xs text-slate-400">@yield('role-label', 'Espace')</div>
                </div>
            </div>
            <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
                @yield('sidebar-links')
            </nav>
            <div class="px-4 py-4 border-t border-slate-800">
                <div class="flex items-center gap-3 px-3 py-2 mb-3">
                    <div class="w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center text-sm font-bold text-slate-900">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="text-sm font-medium text-white truncate">{{ Auth::user()->name }}</div>
                        <div class="text-xs text-slate-400 truncate">{{ Auth::user()->email }}</div>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center gap-2 px-3 py-2 text-sm text-slate-400 hover:text-red-400 hover:bg-red-500/10 rounded-lg transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        Déconnexion
                    </button>
                </form>
            </div>
        </aside>
        <!-- Overlay -->
        <div class="fixed inset-0 z-40 bg-black/50 lg:hidden" x-show="sidebarOpen" @click="sidebarOpen=false" x-transition></div>
        <!-- Main -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top bar -->
            <header class="bg-slate-900 border-b border-slate-800 px-4 py-4 flex items-center gap-4">
                <button @click="sidebarOpen=true" class="lg:hidden text-slate-400 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <h1 class="text-lg font-semibold text-white flex-1">@yield('page-title', 'Dashboard')</h1>
                @yield('header-actions')
            </header>
            <!-- Alerts -->
            @if(session('success'))
                <div x-data="{show:true}" x-show="show" class="mx-4 mt-4 bg-emerald-500/20 border border-emerald-500/30 text-emerald-400 px-4 py-3 rounded-xl flex justify-between items-center">
                    <span>{{ session('success') }}</span>
                    <button @click="show=false" class="text-emerald-400/60 hover:text-emerald-400">×</button>
                </div>
            @endif
            @if(session('error'))
                <div x-data="{show:true}" x-show="show" class="mx-4 mt-4 bg-red-500/20 border border-red-500/30 text-red-400 px-4 py-3 rounded-xl flex justify-between items-center">
                    <span>{{ session('error') }}</span>
                    <button @click="show=false" class="text-red-400/60 hover:text-red-400">×</button>
                </div>
            @endif
            <!-- Content -->
            <main class="flex-1 overflow-y-auto p-4 lg:p-6">
                @yield('content')
            </main>
        </div>
    </div>
    @stack('scripts')
</body>
</html>
