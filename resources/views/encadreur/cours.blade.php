@extends('layouts.dashboard')
@section('title', 'Gestion des Cours')
@section('role-label', 'Espace Encadreur')
@section('page-title', 'Gestion des Cours')

@section('sidebar-links')
<a href="{{ route('encadreur.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 transition-all">Dashboard</a>
<a href="{{ route('encadreur.stagiaires') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 transition-all">Mes Stagiaires</a>
<a href="{{ route('encadreur.presences') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 transition-all">Présences</a>
<a href="{{ route('encadreur.cours') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium bg-emerald-500 text-slate-900 transition-all">Cours</a>
@endsection

@section('header-actions')
<a href="{{ route('encadreur.cours.create') }}" class="flex items-center gap-2 bg-emerald-500 hover:bg-emerald-400 text-slate-900 font-bold px-4 py-2 rounded-xl text-sm transition-colors">
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
    Nouvelle leçon
</a>
@endsection

@section('content')
<div class="space-y-6">
    @forelse($modules as $module)
    <div class="bg-slate-800/50 border border-slate-700/50 rounded-2xl overflow-hidden">
        <div class="px-5 py-4 border-b border-slate-700/50">
            <h3 class="font-bold text-white">{{ $module->titre }}</h3>
            <p class="text-slate-400 text-sm">{{ $module->lecons->count() }} leçon(s)</p>
        </div>
        <div class="divide-y divide-slate-700/30">
            @forelse($module->lecons->sortBy('ordre') as $lecon)
            <div class="flex items-center justify-between px-5 py-3">
                <div>
                    <div class="text-sm font-medium text-white">{{ $lecon->ordre }}. {{ $lecon->titre }}</div>
                    @if($lecon->duree_minutes)
                    <div class="text-xs text-slate-400">{{ $lecon->duree_minutes }} min</div>
                    @endif
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('encadreur.cours.edit', $lecon) }}" class="text-xs text-blue-400 hover:text-blue-300">Modifier</a>
                    <form method="POST" action="{{ route('encadreur.cours.destroy', $lecon) }}" onsubmit="return confirm('Supprimer cette leçon ?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-xs text-red-400 hover:text-red-300">Supprimer</button>
                    </form>
                </div>
            </div>
            @empty
            <div class="px-5 py-4 text-slate-500 text-sm">Aucune leçon dans ce module.</div>
            @endforelse
        </div>
    </div>
    @empty
    <div class="text-center py-16 text-slate-500">Aucun module disponible.</div>
    @endforelse
</div>
@endsection
