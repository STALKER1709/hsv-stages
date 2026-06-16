@extends('layouts.dashboard')
@section('title', 'Budget')
@section('role-label', 'Administration')
@section('page-title', 'Gestion du Budget')

@section('sidebar-links')
<a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 transition-all">Dashboard</a>
<a href="{{ route('admin.stagiaires') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 transition-all">Stagiaires</a>
<a href="{{ route('admin.encadreurs') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 transition-all">Encadreurs</a>
<a href="{{ route('admin.budget') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium bg-emerald-500 text-slate-900 transition-all">Budget</a>
<a href="{{ route('admin.rapports') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 transition-all">Rapports</a>
@endsection

@section('content')
<!-- Summary cards -->
<div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">
    <div class="bg-emerald-500/10 border border-emerald-500/30 rounded-2xl p-6">
        <div class="text-xs text-emerald-400 font-semibold uppercase tracking-wider mb-2">Recettes encaissées</div>
        <div class="text-3xl font-bold text-emerald-400">{{ number_format($stats['recettes_total'], 0, ',', ' ') }}</div>
        <div class="text-sm text-emerald-400/70 mt-0.5">FCFA</div>
    </div>
    <div class="bg-red-500/10 border border-red-500/30 rounded-2xl p-6">
        <div class="text-xs text-red-400 font-semibold uppercase tracking-wider mb-2">Dépenses totales</div>
        <div class="text-3xl font-bold text-red-400">{{ number_format($stats['depenses_total'], 0, ',', ' ') }}</div>
        <div class="text-sm text-red-400/70 mt-0.5">FCFA</div>
    </div>
    <div class="bg-blue-500/10 border border-blue-500/30 rounded-2xl p-6">
        <div class="text-xs text-blue-400 font-semibold uppercase tracking-wider mb-2">Solde</div>
        <div class="text-3xl font-bold {{ $stats['solde'] >= 0 ? 'text-emerald-400' : 'text-red-400' }}">
            {{ number_format($stats['solde'], 0, ',', ' ') }}
        </div>
        <div class="text-sm text-blue-400/70 mt-0.5">FCFA</div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    <!-- Depenses detail -->
    <div class="bg-slate-800/50 border border-slate-700/50 rounded-2xl p-6">
        <h3 class="font-bold text-white mb-4">Détail des dépenses</h3>
        <div class="space-y-3">
            @foreach([
                ['label' => 'Ressources humaines', 'key' => 'depenses_rh', 'color' => 'bg-blue-500'],
                ['label' => 'Communication & Marketing', 'key' => 'depenses_comm', 'color' => 'bg-purple-500'],
                ['label' => 'Logistique & Matériel', 'key' => 'depenses_logistique', 'color' => 'bg-yellow-500'],
                ['label' => 'Mobilier & Fournitures', 'key' => 'depenses_mobilier', 'color' => 'bg-orange-500'],
                ['label' => 'Imprévus (10%)', 'key' => 'depenses_imprevus', 'color' => 'bg-red-500'],
            ] as $dep)
            <div class="flex items-center justify-between gap-4">
                <div class="flex items-center gap-3 flex-1 min-w-0">
                    <div class="w-3 h-3 rounded-full {{ $dep['color'] }} flex-shrink-0"></div>
                    <span class="text-sm text-slate-300 truncate">{{ $dep['label'] }}</span>
                </div>
                <span class="text-sm font-medium text-white flex-shrink-0">{{ number_format($stats[$dep['key']], 0, ',', ' ') }} FCFA</span>
            </div>
            @endforeach
        </div>
    </div>
    <!-- Paiements en attente -->
    <div class="bg-slate-800/50 border border-slate-700/50 rounded-2xl p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="font-bold text-white">Paiements récents</h3>
            <span class="text-xs text-yellow-400">{{ $stats['paiements_attente'] }} en attente</span>
        </div>
        <div class="space-y-3">
            @foreach($paiements->take(6) as $p)
            <div class="flex items-center justify-between gap-3">
                <div class="flex-1 min-w-0">
                    <div class="text-sm text-white truncate">{{ $p->stagiaire->user->name }}</div>
                    <div class="text-xs text-slate-400">{{ ucfirst(str_replace('_', ' ', $p->methode)) }}</div>
                </div>
                <div class="text-right flex-shrink-0">
                    <div class="text-sm font-medium text-white">{{ $p->montantFormate() }}</div>
                    @if($p->statut === 'en_attente')
                    <form method="POST" action="{{ route('admin.paiement.valider', $p) }}" class="mt-1">
                        @csrf
                        <button type="submit" class="text-xs text-emerald-400 hover:text-emerald-300">Valider</button>
                    </form>
                    @else
                    <span class="text-xs text-emerald-400">✓ Validé</span>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
