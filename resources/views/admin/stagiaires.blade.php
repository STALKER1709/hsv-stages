@extends('layouts.dashboard')
@section('title', 'Gestion Stagiaires')
@section('role-label', 'Administration')
@section('page-title', 'Gestion des Stagiaires')

@section('sidebar-links')
<a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 transition-all">Dashboard</a>
<a href="{{ route('admin.stagiaires') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium bg-emerald-500 text-slate-900 transition-all">Stagiaires</a>
<a href="{{ route('admin.encadreurs') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 transition-all">Encadreurs</a>
<a href="{{ route('admin.budget') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 transition-all">Budget</a>
<a href="{{ route('admin.rapports') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 transition-all">Rapports</a>
@endsection

@section('content')
<!-- Filters -->
<form method="GET" class="flex flex-wrap gap-3 mb-6">
    <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher..." class="bg-slate-800 border border-slate-700 rounded-xl px-4 py-2 text-white text-sm focus:outline-none focus:border-emerald-500 w-48">
    <select name="statut" class="bg-slate-800 border border-slate-700 rounded-xl px-4 py-2 text-white text-sm focus:outline-none focus:border-emerald-500">
        <option value="">Tous les statuts</option>
        <option value="en_attente" {{ request('statut') === 'en_attente' ? 'selected' : '' }}>En attente</option>
        <option value="valide" {{ request('statut') === 'valide' ? 'selected' : '' }}>Validé</option>
        <option value="rejete" {{ request('statut') === 'rejete' ? 'selected' : '' }}>Rejeté</option>
    </select>
    <select name="pole_id" class="bg-slate-800 border border-slate-700 rounded-xl px-4 py-2 text-white text-sm focus:outline-none focus:border-emerald-500">
        <option value="">Tous les pôles</option>
        @foreach($poles as $p)
        <option value="{{ $p->id }}" {{ request('pole_id') == $p->id ? 'selected' : '' }}>{{ $p->nom }}</option>
        @endforeach
    </select>
    <button type="submit" class="bg-emerald-500 hover:bg-emerald-400 text-slate-900 font-semibold px-5 py-2 rounded-xl text-sm transition-colors">Filtrer</button>
    <a href="{{ route('admin.stagiaires') }}" class="border border-slate-600 hover:border-slate-500 text-slate-300 px-5 py-2 rounded-xl text-sm transition-colors">Reset</a>
</form>
<div class="bg-slate-800/50 border border-slate-700/50 rounded-2xl overflow-hidden">
    <div class="p-5 border-b border-slate-700/50">
        <h3 class="font-bold text-white">{{ $stagiaires->total() }} stagiaire(s) trouvé(s)</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b border-slate-700/50">
                    <th class="text-left text-xs text-slate-500 uppercase tracking-wider px-5 py-3">Stagiaire</th>
                    <th class="text-left text-xs text-slate-500 uppercase tracking-wider px-5 py-3 hidden md:table-cell">Pôle</th>
                    <th class="text-left text-xs text-slate-500 uppercase tracking-wider px-5 py-3 hidden sm:table-cell">Paiement</th>
                    <th class="text-left text-xs text-slate-500 uppercase tracking-wider px-5 py-3">Statut</th>
                    <th class="text-left text-xs text-slate-500 uppercase tracking-wider px-5 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-700/30">
                @forelse($stagiaires as $s)
                <tr class="hover:bg-slate-700/20 transition-colors">
                    <td class="px-5 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-emerald-500/20 rounded-full flex items-center justify-center text-sm font-bold text-emerald-400 flex-shrink-0">
                                {{ strtoupper(substr($s->user->name, 0, 1)) }}
                            </div>
                            <div>
                                <div class="text-sm font-medium text-white">{{ $s->user->name }}</div>
                                <div class="text-xs text-slate-400">{{ $s->user->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-5 py-4 hidden md:table-cell text-sm text-slate-300">{{ $s->pole?->nom }}</td>
                    <td class="px-5 py-4 hidden sm:table-cell">
                        @if($s->paiement)
                        <span class="text-xs px-2 py-1 rounded-full {{ $s->paiement->statut === 'valide' ? 'bg-emerald-500/20 text-emerald-400' : 'bg-yellow-500/20 text-yellow-400' }}">
                            {{ $s->paiement->statut === 'valide' ? '✓ Payé' : '⏳ Attente' }}
                        </span>
                        @if($s->paiement->preuve_paiement)
                        <a href="{{ asset('storage/' . $s->paiement->preuve_paiement) }}" target="_blank" rel="noopener" class="text-xs text-emerald-400 hover:underline ml-1">Preuve</a>
                        @endif
                        @endif
                    </td>
                    <td class="px-5 py-4">
                        <span class="text-xs px-2 py-1 rounded-full {{ match($s->statut) { 'valide' => 'bg-emerald-500/20 text-emerald-400', 'rejete' => 'bg-red-500/20 text-red-400', default => 'bg-yellow-500/20 text-yellow-400' } }}">
                            {{ match($s->statut) { 'valide' => 'Validé', 'rejete' => 'Rejeté', default => 'En attente' } }}
                        </span>
                    </td>
                    <td class="px-5 py-4">
                        <div class="flex items-center gap-2 flex-wrap">
                            @if($s->statut === 'en_attente')
                            <form method="POST" action="{{ route('admin.stagiaire.valider', $s) }}">
                                @csrf
                                <button type="submit" class="text-xs bg-emerald-500/20 text-emerald-400 hover:bg-emerald-500/30 px-2 py-1 rounded-lg transition-colors">Valider</button>
                            </form>
                            <form method="POST" action="{{ route('admin.stagiaire.rejeter', $s) }}">
                                @csrf
                                <button type="submit" class="text-xs bg-red-500/20 text-red-400 hover:bg-red-500/30 px-2 py-1 rounded-lg transition-colors">Rejeter</button>
                            </form>
                            @endif
                            @if($s->statut === 'valide')
                            <form method="POST" action="{{ route('admin.stagiaire.attestation', $s) }}">
                                @csrf
                                <button type="submit" class="text-xs bg-blue-500/20 text-blue-400 hover:bg-blue-500/30 px-2 py-1 rounded-lg transition-colors">Attestation</button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-5 py-8 text-center text-slate-500">Aucun stagiaire trouvé.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($stagiaires->hasPages())
    <div class="px-5 py-4 border-t border-slate-700/50">
        {{ $stagiaires->links() }}
    </div>
    @endif
</div>
@endsection
