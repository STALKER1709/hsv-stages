@extends('layouts.app')
@section('title', 'Accès refusé')
@section('content')
<div class="pt-16 min-h-screen flex items-center justify-center bg-slate-950">
    <div class="text-center px-4">
        <div class="text-8xl font-black text-red-500/20 mb-4">403</div>
        <h1 class="text-2xl font-bold text-white mb-2">Accès non autorisé</h1>
        <p class="text-slate-400 mb-6">Vous n'avez pas les droits pour accéder à cette page.</p>
        <a href="{{ url('/') }}" class="inline-block bg-emerald-500 hover:bg-emerald-400 text-slate-900 font-bold px-6 py-3 rounded-xl transition-colors">Retour à l'accueil</a>
    </div>
</div>
@endsection
