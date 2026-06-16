@extends('layouts.dashboard')
@section('title', 'Mon Dashboard')
@section('role-label', 'Espace Stagiaire')
@section('page-title', 'Dashboard')

@section('sidebar-links')
<a href="{{ route('stagiaire.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium {{ request()->routeIs('stagiaire.dashboard') ? 'bg-emerald-500 text-slate-900' : 'text-slate-400 hover:text-white hover:bg-slate-800' }} transition-all">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
    Dashboard
</a>
<a href="{{ route('stagiaire.parcours') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium {{ request()->routeIs('stagiaire.parcours*') ? 'bg-emerald-500 text-slate-900' : 'text-slate-400 hover:text-white hover:bg-slate-800' }} transition-all">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
    Mon Parcours
</a>
<a href="{{ route('stagiaire.attestation') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium {{ request()->routeIs('stagiaire.attestation*') ? 'bg-emerald-500 text-slate-900' : 'text-slate-400 hover:text-white hover:bg-slate-800' }} transition-all">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
    Attestation
</a>
<a href="{{ route('stagiaire.profil') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium {{ request()->routeIs('stagiaire.profil*') ? 'bg-emerald-500 text-slate-900' : 'text-slate-400 hover:text-white hover:bg-slate-800' }} transition-all">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
    Mon Profil
</a>
@endsection

@section('content')
<!-- Welcome -->
<div class="mb-6">
    <h2 class="text-2xl font-bold text-white">Bonjour, {{ $user->name }} 👋</h2>
    <p class="text-slate-400 text-sm mt-1">{{ $stagiaire?->pole?->nom ?? 'Aucun pôle assigné' }} — {{ now()->format('d F Y') }}</p>
</div>

<!-- Stats grid -->
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <div class="bg-slate-800/50 border border-slate-700/50 rounded-2xl p-5">
        <div class="text-2xl font-bold text-emerald-400">{{ $stats['progression'] }}%</div>
        <div class="text-sm text-slate-400 mt-1">Progression</div>
        <div class="mt-3 w-full bg-slate-700 rounded-full h-1.5">
            <div class="bg-emerald-500 h-1.5 rounded-full" style="width: {{ $stats['progression'] }}%"></div>
        </div>
    </div>
    <div class="bg-slate-800/50 border border-slate-700/50 rounded-2xl p-5">
        <div class="text-2xl font-bold text-blue-400">{{ $stats['moyenne'] }}/20</div>
        <div class="text-sm text-slate-400 mt-1">Moyenne générale</div>
    </div>
    <div class="bg-slate-800/50 border border-slate-700/50 rounded-2xl p-5">
        <div class="text-2xl font-bold text-purple-400">{{ $stats['taux_presence'] }}%</div>
        <div class="text-sm text-slate-400 mt-1">Taux de présence</div>
    </div>
    <div class="bg-slate-800/50 border border-slate-700/50 rounded-2xl p-5">
        <div class="text-2xl font-bold text-orange-400">{{ $stats['jours_restants'] }}</div>
        <div class="text-sm text-slate-400 mt-1">Jours restants</div>
    </div>
</div>

<!-- Module en cours -->
@if($moduleEnCours)
<div class="bg-gradient-to-r from-emerald-600/20 to-emerald-500/10 border border-emerald-500/30 rounded-2xl p-6 mb-6">
    <div class="flex items-start justify-between gap-4">
        <div>
            <div class="text-xs text-emerald-400 font-semibold uppercase tracking-wider mb-2">Module en cours</div>
            <h3 class="text-xl font-bold text-white mb-2">{{ $moduleEnCours->titre }}</h3>
            <p class="text-slate-400 text-sm">{{ $moduleEnCours->description }}</p>
        </div>
        <a href="{{ route('stagiaire.parcours') }}" class="flex-shrink-0 bg-emerald-500 hover:bg-emerald-400 text-slate-900 font-bold px-5 py-2.5 rounded-xl text-sm transition-colors">
            Continuer →
        </a>
    </div>
</div>
@endif

<!-- Statut paiement -->
@if($stagiaire?->statut === 'en_attente')
<div class="bg-yellow-500/10 border border-yellow-500/30 rounded-2xl p-4">
    <div class="flex items-center gap-3">
        <svg class="w-5 h-5 text-yellow-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <div>
            <div class="text-yellow-400 font-medium text-sm">Validation en attente</div>
            <div class="text-slate-400 text-xs mt-0.5">Votre inscription est en cours de validation par l'équipe HSV.</div>
        </div>
    </div>
</div>
@endif
@endsection
