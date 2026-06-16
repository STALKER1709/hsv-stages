<nav x-data="{ open: false }" class="fixed top-0 left-0 right-0 z-50 bg-slate-900/95 backdrop-blur-md border-b border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <div class="w-9 h-9 bg-gradient-to-br from-emerald-400 to-emerald-600 rounded-xl flex items-center justify-center font-bold text-slate-900 text-lg">H</div>
                <span class="font-bold text-white text-lg hidden sm:block">HSV <span class="text-emerald-400">Stages</span></span>
            </a>
            <div class="hidden md:flex items-center gap-8">
                <a href="{{ route('home') }}" class="text-sm text-slate-300 hover:text-emerald-400 transition-colors">Accueil</a>
                <a href="{{ route('programme') }}" class="text-sm text-slate-300 hover:text-emerald-400 transition-colors">Programme</a>
                <a href="{{ route('inscription') }}" class="text-sm text-slate-300 hover:text-emerald-400 transition-colors">S'inscrire</a>
            </div>
            <div class="flex items-center gap-3">
                @auth
                    <a href="{{ match(Auth::user()->role) { 'admin' => route('admin.dashboard'), 'encadreur' => route('encadreur.dashboard'), default => route('stagiaire.dashboard') } }}"
                       class="text-sm bg-emerald-500 hover:bg-emerald-400 text-slate-900 font-semibold px-4 py-2 rounded-lg transition-colors">
                        Mon espace
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-slate-300 hover:text-white transition-colors">Connexion</a>
                    <a href="{{ route('inscription') }}" class="text-sm bg-emerald-500 hover:bg-emerald-400 text-slate-900 font-semibold px-4 py-2 rounded-lg transition-colors">S'inscrire</a>
                @endauth
                <button @click="open=!open" class="md:hidden text-slate-400 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
        </div>
    </div>
    <!-- Mobile menu -->
    <div x-show="open" x-transition class="md:hidden bg-slate-900 border-t border-slate-800 px-4 py-4 space-y-3">
        <a href="{{ route('home') }}" class="block text-slate-300 hover:text-emerald-400 py-2">Accueil</a>
        <a href="{{ route('programme') }}" class="block text-slate-300 hover:text-emerald-400 py-2">Programme</a>
        <a href="{{ route('inscription') }}" class="block text-slate-300 hover:text-emerald-400 py-2">S'inscrire</a>
    </div>
</nav>
