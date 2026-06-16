@extends('layouts.dashboard')
@section('title', 'Dashboard Admin')
@section('role-label', 'Administration')
@section('page-title', 'Dashboard')

@section('sidebar-links')
<a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-500 text-slate-900' : 'text-slate-400 hover:text-white hover:bg-slate-800' }} transition-all">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
    Dashboard
</a>
<a href="{{ route('admin.stagiaires') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium {{ request()->routeIs('admin.stagiaires*') ? 'bg-emerald-500 text-slate-900' : 'text-slate-400 hover:text-white hover:bg-slate-800' }} transition-all">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
    Stagiaires
</a>
<a href="{{ route('admin.encadreurs') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium {{ request()->routeIs('admin.encadreurs*') ? 'bg-emerald-500 text-slate-900' : 'text-slate-400 hover:text-white hover:bg-slate-800' }} transition-all">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
    Encadreurs
</a>
<a href="{{ route('admin.budget') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium {{ request()->routeIs('admin.budget*') ? 'bg-emerald-500 text-slate-900' : 'text-slate-400 hover:text-white hover:bg-slate-800' }} transition-all">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    Budget
</a>
<a href="{{ route('admin.rapports') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium {{ request()->routeIs('admin.rapports*') ? 'bg-emerald-500 text-slate-900' : 'text-slate-400 hover:text-white hover:bg-slate-800' }} transition-all">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
    Rapports
</a>
@endsection

@section('content')
<!-- KPI Cards -->
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
    <div class="bg-slate-800/50 border border-slate-700/50 rounded-2xl p-5">
        <div class="text-3xl font-bold text-emerald-400">{{ $stats['stagiaires_total'] }}</div>
        <div class="text-sm text-slate-400 mt-1">Total stagiaires</div>
        <div class="text-xs text-emerald-500 mt-1">{{ $stats['stagiaires_valides'] }} validés</div>
    </div>
    <div class="bg-slate-800/50 border border-slate-700/50 rounded-2xl p-5">
        <div class="text-3xl font-bold text-blue-400">{{ $stats['encadreurs_total'] }}</div>
        <div class="text-sm text-slate-400 mt-1">Encadreurs</div>
        <div class="text-xs text-slate-500 mt-1">{{ $stats['poles_total'] }} pôles</div>
    </div>
    <div class="bg-slate-800/50 border border-slate-700/50 rounded-2xl p-5">
        <div class="text-2xl font-bold text-yellow-400">{{ number_format($stats['recettes_total'], 0, ',', ' ') }}</div>
        <div class="text-sm text-slate-400 mt-1">FCFA encaissés</div>
        <div class="text-xs text-yellow-500 mt-1">{{ $stats['paiements_attente'] }} en attente</div>
    </div>
    <div class="bg-slate-800/50 border border-slate-700/50 rounded-2xl p-5">
        <div class="text-3xl font-bold text-orange-400">{{ $stats['stagiaires_attente'] }}</div>
        <div class="text-sm text-slate-400 mt-1">En attente validation</div>
        @if($stats['stagiaires_attente'] > 0)
        <a href="{{ route('admin.stagiaires') }}?statut=en_attente" class="text-xs text-orange-400 mt-1 block hover:text-orange-300">Valider →</a>
        @endif
    </div>
</div>

<!-- Poles repartition -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    <div class="bg-slate-800/50 border border-slate-700/50 rounded-2xl p-6">
        <h3 class="font-bold text-white mb-4">Répartition par pôle</h3>
        <div class="space-y-3">
            @foreach($poles as $pole)
            <div>
                <div class="flex justify-between text-sm mb-1">
                    <span class="text-slate-300">{{ $pole->nom }}</span>
                    <span class="text-slate-400">{{ $pole->stagiaires_count }} stagiaires</span>
                </div>
                <div class="w-full bg-slate-700 rounded-full h-2">
                    @php $pct = $stats['stagiaires_total'] > 0 ? round(($pole->stagiaires_count / $stats['stagiaires_total']) * 100) : 0 @endphp
                    <div class="bg-emerald-500 h-2 rounded-full" style="width: {{ $pct }}%"></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="bg-slate-800/50 border border-slate-700/50 rounded-2xl p-6">
        <h3 class="font-bold text-white mb-4">Dernières inscriptions</h3>
        <div class="space-y-3">
            @foreach($derniersStagiaires->take(5) as $s)
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-emerald-500/20 rounded-full flex items-center justify-center text-sm font-bold text-emerald-400 flex-shrink-0">
                    {{ strtoupper(substr($s->user->name, 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <div class="text-sm text-white truncate">{{ $s->user->name }}</div>
                    <div class="text-xs text-slate-400">{{ $s->pole?->nom }}</div>
                </div>
                <span class="text-xs px-2 py-0.5 rounded-full flex-shrink-0 {{ $s->statut === 'valide' ? 'bg-emerald-500/20 text-emerald-400' : 'bg-yellow-500/20 text-yellow-400' }}">
                    {{ $s->statut === 'valide' ? 'Validé' : 'Attente' }}
                </span>
            </div>
            @endforeach
        </div>
        <div class="mt-4 pt-4 border-t border-slate-700/50">
            <a href="{{ route('admin.stagiaires') }}" class="text-sm text-emerald-400 hover:text-emerald-300">Voir tous les stagiaires →</a>
        </div>
    </div>
</div>
@endsection
