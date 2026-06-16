@extends('layouts.app')
@section('title', 'Page introuvable')
@section('content')
<div class="pt-16 min-h-screen flex items-center justify-center bg-slate-950">
    <div class="text-center px-4">
        <div class="text-8xl font-black text-slate-700 mb-4">404</div>
        <h1 class="text-2xl font-bold text-white mb-2">Page introuvable</h1>
        <p class="text-slate-400 mb-6">La page que vous cherchez n'existe pas ou a été déplacée.</p>
        <a href="{{ url('/') }}" class="inline-block bg-emerald-500 hover:bg-emerald-400 text-slate-900 font-bold px-6 py-3 rounded-xl transition-colors">Retour à l'accueil</a>
    </div>
</div>
@endsection
