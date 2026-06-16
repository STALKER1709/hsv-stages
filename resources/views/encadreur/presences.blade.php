@extends('layouts.dashboard')
@section('title', 'Présences')
@section('role-label', 'Espace Encadreur')
@section('page-title', 'Gestion des Présences')

@section('sidebar-links')
<a href="{{ route('encadreur.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 transition-all">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
    Dashboard
</a>
<a href="{{ route('encadreur.stagiaires') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 transition-all">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
    Mes Stagiaires
</a>
<a href="{{ route('encadreur.presences') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium bg-emerald-500 text-slate-900 transition-all">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
    Présences
</a>
<a href="{{ route('encadreur.cours') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 transition-all">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253"/></svg>
    Cours
</a>
@endsection

@section('content')
<form method="POST" action="{{ route('encadreur.presences.store') }}" class="space-y-6">
    @csrf
    <div class="flex items-center gap-4">
        <div>
            <label class="block text-sm text-slate-400 mb-2">Date</label>
            <input type="date" name="date" value="{{ $today }}" class="bg-slate-800 border border-slate-700 rounded-xl px-4 py-2.5 text-white focus:outline-none focus:border-emerald-500">
        </div>
        <button type="submit" class="mt-6 bg-emerald-500 hover:bg-emerald-400 text-slate-900 font-bold px-6 py-2.5 rounded-xl transition-colors">
            Enregistrer les présences
        </button>
    </div>
    <div class="bg-slate-800/50 border border-slate-700/50 rounded-2xl overflow-hidden">
        <div class="p-5 border-b border-slate-700/50">
            <h3 class="font-bold text-white">Feuille de présence — {{ $stagiaires->count() }} stagiaires</h3>
        </div>
        <div class="divide-y divide-slate-700/30">
            @forelse($stagiaires as $s)
            <div class="flex items-center justify-between px-5 py-4 hover:bg-slate-700/20 transition-colors">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-emerald-500/20 rounded-full flex items-center justify-center text-sm font-bold text-emerald-400">
                        {{ strtoupper(substr($s->user->name, 0, 1)) }}
                    </div>
                    <div>
                        <div class="text-sm font-medium text-white">{{ $s->user->name }}</div>
                        <div class="text-xs text-slate-400">{{ $s->filiere }} — {{ $s->niveau }}</div>
                    </div>
                </div>
                <label class="flex items-center gap-3 cursor-pointer">
                    <span class="text-sm text-slate-400">Présent</span>
                    <div class="relative" x-data="{ checked: {{ $s->presences->where('date', $today)->first()?->present ? 'true' : 'false' }} }">
                        <input type="checkbox" name="presences[]" value="{{ $s->id }}"
                               x-model="checked"
                               {{ $s->presences->where('date', $today)->first()?->present ? 'checked' : '' }}
                               class="sr-only">
                        <div @click="checked = !checked" class="w-12 h-6 rounded-full transition-colors cursor-pointer"
                             :class="checked ? 'bg-emerald-500' : 'bg-slate-600'">
                            <div class="w-5 h-5 bg-white rounded-full shadow transition-transform m-0.5"
                                 :class="checked ? 'translate-x-6' : 'translate-x-0'"></div>
                        </div>
                    </div>
                </label>
            </div>
            @empty
            <div class="px-5 py-8 text-center text-slate-500">Aucun stagiaire dans ce pôle.</div>
            @endforelse
        </div>
    </div>
</form>
@endsection
