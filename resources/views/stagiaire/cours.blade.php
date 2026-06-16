@extends('layouts.dashboard')
@section('title', $lecon->titre)
@section('role-label', 'Espace Stagiaire')
@section('page-title', $lecon->titre)

@section('sidebar-links')
<a href="{{ route('stagiaire.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 transition-all">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
    Dashboard
</a>
<a href="{{ route('stagiaire.parcours') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium bg-emerald-500 text-slate-900 transition-all">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
    Mon Parcours
</a>
@endsection

@section('header-actions')
<div class="flex items-center gap-2 text-sm text-slate-400">
    <span>{{ $lecon->module->titre }}</span>
    <span>•</span>
    <span>{{ $lecon->module->pole->nom }}</span>
</div>
@endsection

@section('content')
<div class="max-w-3xl">
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-sm text-slate-500 mb-6">
        <a href="{{ route('stagiaire.parcours') }}" class="hover:text-emerald-400">Parcours</a>
        <span>›</span>
        <span class="text-slate-400">{{ $lecon->titre }}</span>
    </div>
    <!-- Content -->
    <div class="bg-slate-800/50 border border-slate-700/50 rounded-2xl p-6 lg:p-8 mb-6 prose prose-invert prose-emerald max-w-none">
        {!! $lecon->contenu !!}
    </div>
    <!-- Navigation -->
    <div class="flex items-center justify-between gap-4">
        @if($precedente)
        <a href="{{ route('stagiaire.cours', $precedente) }}" class="flex items-center gap-2 text-sm text-slate-400 hover:text-white border border-slate-700 hover:border-slate-600 px-4 py-3 rounded-xl transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            {{ $precedente->titre }}
        </a>
        @else
        <div></div>
        @endif
        @if($suivante)
        <a href="{{ route('stagiaire.cours', $suivante) }}" class="flex items-center gap-2 text-sm bg-emerald-500 hover:bg-emerald-400 text-slate-900 font-semibold px-4 py-3 rounded-xl transition-all">
            {{ $suivante->titre }}
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>
        @endif
    </div>
</div>
@endsection
