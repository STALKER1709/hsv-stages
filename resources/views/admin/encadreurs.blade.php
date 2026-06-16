@extends('layouts.dashboard')
@section('title', 'Gestion Encadreurs')
@section('role-label', 'Administration')
@section('page-title', 'Gestion des Encadreurs')

@section('sidebar-links')
<a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 transition-all">Dashboard</a>
<a href="{{ route('admin.stagiaires') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 transition-all">Stagiaires</a>
<a href="{{ route('admin.encadreurs') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium bg-emerald-500 text-slate-900 transition-all">Encadreurs</a>
<a href="{{ route('admin.budget') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 transition-all">Budget</a>
<a href="{{ route('admin.rapports') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 transition-all">Rapports</a>
@endsection

@section('header-actions')
<a href="{{ route('admin.encadreur.create') }}" class="flex items-center gap-2 bg-emerald-500 hover:bg-emerald-400 text-slate-900 font-bold px-4 py-2 rounded-xl text-sm transition-colors">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
    Ajouter
</a>
@endsection

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
    @forelse($encadreurs as $e)
    <div class="bg-slate-800/50 border border-slate-700/50 rounded-2xl p-5">
        <div class="flex items-center gap-3 mb-3">
            <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl flex items-center justify-center text-lg font-bold text-white">
                {{ strtoupper(substr($e->user->name, 0, 1)) }}
            </div>
            <div>
                <div class="font-bold text-white">{{ $e->user->name }}</div>
                <div class="text-xs text-slate-400">{{ $e->pole?->nom }}</div>
            </div>
        </div>
        <div class="text-sm text-slate-300 mb-1">{{ $e->specialite }}</div>
        <div class="text-xs text-slate-500 mb-3">{{ $e->user->email }}</div>
        <div class="flex items-center justify-between">
            <span class="text-xs text-slate-500">{{ $e->user->telephone }}</span>
            <form method="POST" action="{{ route('admin.encadreur.destroy', $e) }}" onsubmit="return confirm('Supprimer cet encadreur ?')">
                @csrf @method('DELETE')
                <button type="submit" class="text-xs text-red-400 hover:text-red-300 transition-colors">Supprimer</button>
            </form>
        </div>
    </div>
    @empty
    <div class="col-span-3 text-center py-12 text-slate-500">Aucun encadreur enregistré.</div>
    @endforelse
</div>
@endsection
