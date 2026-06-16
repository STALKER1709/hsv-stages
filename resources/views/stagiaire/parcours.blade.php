@extends('layouts.dashboard')
@section('title', 'Mon Parcours')
@section('role-label', 'Espace Stagiaire')
@section('page-title', 'Mon Parcours')

@section('sidebar-links')
<a href="{{ route('stagiaire.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 transition-all">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
    Dashboard
</a>
<a href="{{ route('stagiaire.parcours') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium bg-emerald-500 text-slate-900 transition-all">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
    Mon Parcours
</a>
<a href="{{ route('stagiaire.attestation') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 transition-all">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
    Attestation
</a>
<a href="{{ route('stagiaire.profil') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 transition-all">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
    Mon Profil
</a>
@endsection

@section('content')
<div class="space-y-6">
    @forelse($modules as $module)
    <div class="bg-slate-800/50 border border-slate-700/50 rounded-2xl overflow-hidden">
        <div class="p-5 border-b border-slate-700/50 flex items-center justify-between">
            <div>
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-emerald-500/20 border border-emerald-500/30 rounded-lg flex items-center justify-center text-emerald-400 text-sm font-bold">{{ $module->ordre }}</div>
                    <h3 class="font-bold text-white">{{ $module->titre }}</h3>
                </div>
                <p class="text-slate-400 text-sm mt-1 ml-11">{{ $module->description }}</p>
            </div>
            <span class="text-xs text-slate-500 flex-shrink-0">{{ $module->duree_semaines }}s</span>
        </div>
        <div class="divide-y divide-slate-700/50">
            @foreach($module->lecons->sortBy('ordre') as $lecon)
            <div class="flex items-center gap-4 px-5 py-3 hover:bg-slate-700/30 transition-colors">
                <div class="w-6 h-6 rounded-full bg-emerald-500/20 border border-emerald-500/30 flex items-center justify-center flex-shrink-0">
                    <svg class="w-3 h-3 text-emerald-400" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                </div>
                <div class="flex-1 min-w-0">
                    <div class="text-sm text-white truncate">{{ $lecon->titre }}</div>
                    @if($lecon->duree_minutes)
                    <div class="text-xs text-slate-500">{{ $lecon->duree_minutes }} min</div>
                    @endif
                </div>
                <a href="{{ route('stagiaire.cours', $lecon) }}" class="text-xs text-emerald-400 hover:text-emerald-300 font-medium">Voir →</a>
            </div>
            @endforeach
        </div>
        @if($module->evaluations->count())
        <div class="px-5 py-3 bg-blue-500/5 border-t border-blue-500/20">
            @foreach($module->evaluations as $eval)
            <div class="flex items-center justify-between">
                <span class="text-sm text-blue-400">📝 {{ $eval->titre }}</span>
                <a href="{{ route('stagiaire.evaluation', $eval) }}" class="text-xs bg-blue-500/20 text-blue-400 hover:bg-blue-500/30 px-3 py-1 rounded-lg transition-colors">Passer</a>
            </div>
            @endforeach
        </div>
        @endif
    </div>
    @empty
    <div class="text-center py-16 text-slate-500">
        <svg class="w-12 h-12 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253"/></svg>
        <p>Aucun module disponible pour le moment.</p>
    </div>
    @endforelse
</div>
@endsection
