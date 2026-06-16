@extends('layouts.dashboard')
@section('title', 'Dashboard Encadreur')
@section('role-label', 'Espace Encadreur')
@section('page-title', 'Dashboard')

@section('sidebar-links')
<a href="{{ route('encadreur.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium {{ request()->routeIs('encadreur.dashboard') ? 'bg-emerald-500 text-slate-900' : 'text-slate-400 hover:text-white hover:bg-slate-800' }} transition-all">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
    Dashboard
</a>
<a href="{{ route('encadreur.stagiaires') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium {{ request()->routeIs('encadreur.stagiaires*') ? 'bg-emerald-500 text-slate-900' : 'text-slate-400 hover:text-white hover:bg-slate-800' }} transition-all">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
    Mes Stagiaires
</a>
<a href="{{ route('encadreur.presences') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium {{ request()->routeIs('encadreur.presences*') ? 'bg-emerald-500 text-slate-900' : 'text-slate-400 hover:text-white hover:bg-slate-800' }} transition-all">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
    Présences
</a>
<a href="{{ route('encadreur.cours') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium {{ request()->routeIs('encadreur.cours*') ? 'bg-emerald-500 text-slate-900' : 'text-slate-400 hover:text-white hover:bg-slate-800' }} transition-all">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253"/></svg>
    Cours
</a>
@endsection

@section('content')
<div class="mb-6">
    <h2 class="text-2xl font-bold text-white">Bonjour, {{ Auth::user()->name }}</h2>
    <p class="text-slate-400 text-sm mt-1">{{ $encadreur?->pole?->nom ?? 'Pôle non assigné' }} — {{ $encadreur?->specialite }}</p>
</div>
<div class="grid grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
    <div class="bg-slate-800/50 border border-slate-700/50 rounded-2xl p-5">
        <div class="text-3xl font-bold text-emerald-400">{{ $stats['total_stagiaires'] }}</div>
        <div class="text-sm text-slate-400 mt-1">Stagiaires au total</div>
    </div>
    <div class="bg-slate-800/50 border border-slate-700/50 rounded-2xl p-5">
        <div class="text-3xl font-bold text-blue-400">{{ $stats['stagiaires_valides'] }}</div>
        <div class="text-sm text-slate-400 mt-1">Stagiaires validés</div>
    </div>
    <div class="bg-slate-800/50 border border-slate-700/50 rounded-2xl p-5">
        <div class="text-3xl font-bold text-purple-400">{{ $stats['modules_total'] }}</div>
        <div class="text-sm text-slate-400 mt-1">Modules dans le pôle</div>
    </div>
</div>
<div class="bg-slate-800/50 border border-slate-700/50 rounded-2xl p-6">
    <h3 class="font-bold text-white mb-4">Stagiaires récents</h3>
    <div class="space-y-3">
        @forelse($stagiaires->take(5) as $s)
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 bg-emerald-500/20 rounded-full flex items-center justify-center text-sm font-bold text-emerald-400">
                {{ strtoupper(substr($s->user->name, 0, 1)) }}
            </div>
            <div class="flex-1">
                <div class="text-sm font-medium text-white">{{ $s->user->name }}</div>
                <div class="text-xs text-slate-400">{{ $s->etablissement }} — {{ $s->niveau }}</div>
            </div>
            <span class="text-xs px-2 py-1 rounded-full {{ $s->statut === 'valide' ? 'bg-emerald-500/20 text-emerald-400' : 'bg-yellow-500/20 text-yellow-400' }}">
                {{ $s->statut === 'valide' ? 'Validé' : 'En attente' }}
            </span>
        </div>
        @empty
        <p class="text-slate-500 text-sm">Aucun stagiaire dans ce pôle.</p>
        @endforelse
    </div>
    @if($stagiaires->count() > 5)
    <div class="mt-4 pt-4 border-t border-slate-700/50">
        <a href="{{ route('encadreur.stagiaires') }}" class="text-sm text-emerald-400 hover:text-emerald-300">Voir tous les stagiaires →</a>
    </div>
    @endif
</div>
@endsection
