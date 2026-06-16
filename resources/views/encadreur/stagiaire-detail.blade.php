@extends('layouts.dashboard')
@section('title', $stagiaire->user->name)
@section('role-label', 'Espace Encadreur')
@section('page-title', 'Détail Stagiaire')

@section('sidebar-links')
<a href="{{ route('encadreur.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 transition-all">Dashboard</a>
<a href="{{ route('encadreur.stagiaires') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium bg-emerald-500 text-slate-900 transition-all">Mes Stagiaires</a>
<a href="{{ route('encadreur.presences') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 transition-all">Présences</a>
<a href="{{ route('encadreur.cours') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 transition-all">Cours</a>
@endsection

@section('content')
<div class="max-w-3xl space-y-6">
    <!-- Identity -->
    <div class="bg-slate-800/50 border border-slate-700/50 rounded-2xl p-6">
        <div class="flex items-center gap-4 mb-4">
            <div class="w-16 h-16 bg-gradient-to-br from-emerald-400 to-emerald-600 rounded-2xl flex items-center justify-center text-2xl font-bold text-slate-900">
                {{ strtoupper(substr($stagiaire->user->name, 0, 1)) }}
            </div>
            <div>
                <h2 class="text-xl font-bold text-white">{{ $stagiaire->user->name }}</h2>
                <p class="text-slate-400 text-sm">{{ $stagiaire->user->email }}</p>
                <span class="inline-block mt-1 text-xs px-2 py-0.5 rounded-full {{ $stagiaire->statut === 'valide' ? 'bg-emerald-500/20 text-emerald-400' : 'bg-yellow-500/20 text-yellow-400' }}">
                    {{ $stagiaire->statut === 'valide' ? 'Validé' : 'En attente' }}
                </span>
            </div>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 text-sm">
            <div><span class="text-slate-500">Établissement</span><div class="text-white mt-0.5">{{ $stagiaire->etablissement }}</div></div>
            <div><span class="text-slate-500">Filière</span><div class="text-white mt-0.5">{{ $stagiaire->filiere }}</div></div>
            <div><span class="text-slate-500">Niveau</span><div class="text-white mt-0.5">{{ $stagiaire->niveau }}</div></div>
            <div><span class="text-slate-500">Téléphone</span><div class="text-white mt-0.5">{{ $stagiaire->user->telephone }}</div></div>
        </div>
    </div>
    <!-- Stats -->
    <div class="grid grid-cols-3 gap-4">
        <div class="bg-slate-800/50 border border-slate-700/50 rounded-2xl p-4 text-center">
            <div class="text-2xl font-bold text-emerald-400">{{ $stagiaire->progressionGlobale() }}%</div>
            <div class="text-xs text-slate-400 mt-1">Progression</div>
        </div>
        <div class="bg-slate-800/50 border border-slate-700/50 rounded-2xl p-4 text-center">
            <div class="text-2xl font-bold text-blue-400">{{ $stagiaire->moyenneGenerale() }}/20</div>
            <div class="text-xs text-slate-400 mt-1">Moyenne</div>
        </div>
        <div class="bg-slate-800/50 border border-slate-700/50 rounded-2xl p-4 text-center">
            <div class="text-2xl font-bold text-purple-400">{{ $stagiaire->tauxPresence() }}%</div>
            <div class="text-xs text-slate-400 mt-1">Présence</div>
        </div>
    </div>
    <!-- Results -->
    @if($stagiaire->resultats->count())
    <div class="bg-slate-800/50 border border-slate-700/50 rounded-2xl p-6">
        <h3 class="font-bold text-white mb-4">Résultats des évaluations</h3>
        <div class="space-y-3">
            @foreach($stagiaire->resultats as $r)
            <div class="flex items-center justify-between py-2 border-b border-slate-700/30 last:border-0">
                <span class="text-sm text-slate-300">{{ $r->evaluation->titre }}</span>
                <div class="text-right">
                    <span class="font-bold text-white">{{ $r->score }}/20</span>
                    <span class="text-xs text-slate-500 ml-2">{{ $r->mention() }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
