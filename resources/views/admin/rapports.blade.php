@extends('layouts.dashboard')
@section('title', 'Rapports')
@section('role-label', 'Administration')
@section('page-title', 'Rapports & Exports')

@section('sidebar-links')
<a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 transition-all">Dashboard</a>
<a href="{{ route('admin.stagiaires') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 transition-all">Stagiaires</a>
<a href="{{ route('admin.encadreurs') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 transition-all">Encadreurs</a>
<a href="{{ route('admin.budget') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 transition-all">Budget</a>
<a href="{{ route('admin.rapports') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium bg-emerald-500 text-slate-900 transition-all">Rapports</a>
@endsection

@section('content')
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    <div class="bg-slate-800/50 border border-slate-700/50 rounded-2xl p-6">
        <div class="w-12 h-12 bg-emerald-500/20 border border-emerald-500/30 rounded-xl flex items-center justify-center mb-4">
            <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1z"/></svg>
        </div>
        <h3 class="font-bold text-white mb-2">Liste des stagiaires</h3>
        <p class="text-slate-400 text-sm mb-4">Export CSV de tous les stagiaires avec leurs informations complètes.</p>
        <a href="{{ route('admin.rapports.stagiaires') }}" class="inline-flex items-center gap-2 bg-emerald-500 hover:bg-emerald-400 text-slate-900 font-semibold px-4 py-2.5 rounded-xl text-sm transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            Télécharger CSV
        </a>
    </div>
    <div class="bg-slate-800/50 border border-slate-700/50 rounded-2xl p-6">
        <div class="w-12 h-12 bg-blue-500/20 border border-blue-500/30 rounded-xl flex items-center justify-center mb-4">
            <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <h3 class="font-bold text-white mb-2">Rapport financier</h3>
        <p class="text-slate-400 text-sm mb-4">Récapitulatif des paiements et du budget de la promotion.</p>
        <a href="{{ route('admin.budget') }}" class="inline-flex items-center gap-2 bg-blue-500 hover:bg-blue-400 text-white font-semibold px-4 py-2.5 rounded-xl text-sm transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
            Voir le budget
        </a>
    </div>
</div>
@endsection
