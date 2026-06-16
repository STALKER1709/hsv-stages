@extends('layouts.app')
@section('title', 'Accueil')
@section('content')
<div class="pt-16">
    <!-- Hero -->
    <section class="relative min-h-screen flex items-center overflow-hidden bg-gradient-to-br from-slate-950 via-slate-900 to-slate-950">
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-20 left-10 w-72 h-72 bg-emerald-500/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <div class="inline-flex items-center gap-2 bg-emerald-500/10 border border-emerald-500/20 rounded-full px-4 py-2 text-emerald-400 text-sm font-medium mb-6">
                        <span class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></span>
                        Inscriptions ouvertes — Promotion 2025
                    </div>
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-6">
                        Lancez votre carrière<br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-emerald-600">en informatique</span>
                    </h1>
                    <p class="text-slate-400 text-lg leading-relaxed mb-8 max-w-lg">
                        Stage académique intensif de 3 mois. Formation pratique en Génie Logiciel, Systèmes & Réseaux ou Software Engineering. Certifié et reconnu par les employeurs camerounais.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('inscription') }}" class="inline-flex items-center justify-center gap-2 bg-emerald-500 hover:bg-emerald-400 text-slate-900 font-bold px-8 py-4 rounded-xl text-lg transition-all hover:scale-105">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                            S'inscrire maintenant
                        </a>
                        <a href="{{ route('programme') }}" class="inline-flex items-center justify-center gap-2 border border-slate-600 hover:border-emerald-500 text-slate-300 hover:text-emerald-400 font-semibold px-8 py-4 rounded-xl text-lg transition-all">
                            Voir le programme
                        </a>
                    </div>
                    <div class="grid grid-cols-3 gap-6 mt-12 pt-8 border-t border-slate-800">
                        <div>
                            <div class="text-3xl font-extrabold text-white">{{ $totalStagiaires }}+</div>
                            <div class="text-slate-400 text-sm mt-1">Stagiaires formés</div>
                        </div>
                        <div>
                            <div class="text-3xl font-extrabold text-emerald-400">3</div>
                            <div class="text-slate-400 text-sm mt-1">Pôles de formation</div>
                        </div>
                        <div>
                            <div class="text-3xl font-extrabold text-white">100%</div>
                            <div class="text-slate-400 text-sm mt-1">Certifiés</div>
                        </div>
                    </div>
                </div>
                <div class="hidden lg:block">
                    <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=600&q=80" alt="Étudiants en informatique" class="rounded-2xl shadow-2xl">
                </div>
            </div>
        </div>
    </section>

    <!-- Poles -->
    <section class="py-20 bg-slate-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">Nos pôles de formation</h2>
                <p class="text-slate-400 max-w-2xl mx-auto">Choisissez le domaine qui correspond à vos ambitions et construisez une expertise reconnue.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($poles as $pole)
                <div class="bg-slate-800/50 border border-slate-700/50 rounded-2xl p-6 hover:border-emerald-500/40 transition-all hover:-translate-y-1 group">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform"
                         style="background-color: {{ $pole->couleur ?? '#10b981' }}20; border: 1px solid {{ $pole->couleur ?? '#10b981' }}40">
                        <div class="w-5 h-5 rounded-full" style="background-color: {{ $pole->couleur ?? '#10b981' }}"></div>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">{{ $pole->nom }}</h3>
                    <p class="text-slate-400 text-sm mb-4 leading-relaxed">{{ $pole->description }}</p>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-slate-500">{{ $pole->stagiaires_count }} stagiaire(s)</span>
                        <a href="{{ route('inscription') }}" class="text-sm text-emerald-400 hover:text-emerald-300 font-medium">Rejoindre →</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA Inscription -->
    <section class="py-20 bg-gradient-to-r from-emerald-600 to-emerald-500">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 mb-4">Prêt à démarrer ?</h2>
            <p class="text-emerald-900 text-lg mb-8">Inscription : 50 000 FCFA — Paiement Orange Money, MTN MoMo ou Espèces</p>
            <a href="{{ route('inscription') }}" class="inline-flex items-center gap-2 bg-slate-900 hover:bg-slate-800 text-white font-bold px-10 py-4 rounded-xl text-lg transition-all hover:scale-105">
                Commencer mon inscription
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
            </a>
        </div>
    </section>
</div>
@endsection
