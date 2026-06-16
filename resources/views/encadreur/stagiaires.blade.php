@extends('layouts.dashboard')
@section('title', 'Mes Stagiaires')
@section('role-label', 'Espace Encadreur')
@section('page-title', 'Mes Stagiaires')

@section('sidebar-links')
<a href="{{ route('encadreur.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 transition-all">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
    Dashboard
</a>
<a href="{{ route('encadreur.stagiaires') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium bg-emerald-500 text-slate-900 transition-all">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
    Mes Stagiaires
</a>
<a href="{{ route('encadreur.presences') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 transition-all">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
    Présences
</a>
<a href="{{ route('encadreur.cours') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 transition-all">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253"/></svg>
    Cours
</a>
@endsection

@section('content')
<div class="bg-slate-800/50 border border-slate-700/50 rounded-2xl overflow-hidden">
    <div class="p-5 border-b border-slate-700/50">
        <h3 class="font-bold text-white">Liste des stagiaires — {{ $stagiaires->total() }} au total</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b border-slate-700/50">
                    <th class="text-left text-xs text-slate-500 uppercase tracking-wider px-5 py-3">Stagiaire</th>
                    <th class="text-left text-xs text-slate-500 uppercase tracking-wider px-5 py-3 hidden sm:table-cell">Établissement</th>
                    <th class="text-left text-xs text-slate-500 uppercase tracking-wider px-5 py-3 hidden md:table-cell">Niveau</th>
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
                    <td class="px-5 py-4 hidden sm:table-cell text-sm text-slate-300">{{ $s->etablissement }}</td>
                    <td class="px-5 py-4 hidden md:table-cell">
                        <span class="text-xs bg-slate-700 text-slate-300 px-2 py-1 rounded-lg">{{ $s->niveau }}</span>
                    </td>
                    <td class="px-5 py-4">
                        <span class="text-xs px-2 py-1 rounded-full {{ $s->statut === 'valide' ? 'bg-emerald-500/20 text-emerald-400' : 'bg-yellow-500/20 text-yellow-400' }}">
                            {{ $s->statut === 'valide' ? 'Validé' : 'En attente' }}
                        </span>
                    </td>
                    <td class="px-5 py-4">
                        <a href="{{ route('encadreur.stagiaire.show', $s) }}" class="text-xs text-emerald-400 hover:text-emerald-300">Voir →</a>
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
