@extends('layouts.dashboard')
@section('title', $evaluation->titre)
@section('role-label', 'Espace Stagiaire')
@section('page-title', $evaluation->titre)

@section('sidebar-links')
<a href="{{ route('stagiaire.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 transition-all">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
    Dashboard
</a>
<a href="{{ route('stagiaire.parcours') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 transition-all">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253"/></svg>
    Mon Parcours
</a>
@endsection

@section('content')
<div class="max-w-2xl">
    @if($resultat)
    <div class="bg-emerald-500/10 border border-emerald-500/30 rounded-2xl p-6 mb-6">
        <div class="text-center">
            <div class="text-4xl font-extrabold text-emerald-400 mb-2">{{ $resultat->score }}/20</div>
            <div class="text-slate-300 font-medium">{{ $resultat->mention() }}</div>
            <div class="text-slate-500 text-sm mt-2">Passé le {{ $resultat->created_at->format('d/m/Y') }}</div>
        </div>
        <div class="mt-4 text-center">
            <a href="{{ route('stagiaire.parcours') }}" class="text-sm text-emerald-400 hover:text-emerald-300">← Retour au parcours</a>
        </div>
    </div>
    @endif
    <div class="bg-slate-800/50 border border-slate-700/50 rounded-2xl p-6 mb-6">
        <div class="flex items-center justify-between mb-2">
            <h2 class="font-bold text-white">{{ $evaluation->titre }}</h2>
            <span class="text-sm text-slate-400">{{ $evaluation->questions->count() }} questions • {{ $evaluation->duree_minutes }} min</span>
        </div>
        <p class="text-slate-400 text-sm">Module : {{ $evaluation->module->titre }}</p>
    </div>
    @if(!$resultat)
    <form method="POST" action="{{ route('stagiaire.evaluation.submit', $evaluation) }}" class="space-y-6">
        @csrf
        @foreach($evaluation->questions->sortBy('ordre') as $index => $question)
        <div class="bg-slate-800/50 border border-slate-700/50 rounded-2xl p-6">
            <p class="text-white font-medium mb-4">{{ $index + 1 }}. {{ $question->texte }}</p>
            <div class="space-y-3">
                @foreach($question->reponses as $reponse)
                <label class="flex items-center gap-3 p-3 border border-slate-700 rounded-xl cursor-pointer hover:border-emerald-500/50 hover:bg-emerald-500/5 transition-all">
                    <input type="radio" name="reponse_{{ $question->id }}" value="{{ $reponse->id }}" class="text-emerald-500 focus:ring-emerald-500 border-slate-600 bg-slate-800">
                    <span class="text-slate-300 text-sm">{{ $reponse->texte }}</span>
                </label>
                @endforeach
            </div>
        </div>
        @endforeach
        <button type="submit" class="w-full bg-emerald-500 hover:bg-emerald-400 text-slate-900 font-bold py-4 rounded-xl transition-colors text-lg">
            Soumettre l'évaluation ✓
        </button>
    </form>
    @endif
</div>
@endsection
