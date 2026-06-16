@extends('layouts.dashboard')
@section('title', 'Modifier la leçon')
@section('role-label', 'Espace Encadreur')
@section('page-title', 'Modifier la leçon')

@section('sidebar-links')
<a href="{{ route('encadreur.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 transition-all">Dashboard</a>
<a href="{{ route('encadreur.cours') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium bg-emerald-500 text-slate-900 transition-all">Cours</a>
@endsection

@section('content')
<div class="max-w-2xl">
    <div class="bg-slate-800/50 border border-slate-700/50 rounded-2xl p-6">
        <form method="POST" action="{{ route('encadreur.cours.update', $lecon) }}" class="space-y-5">
            @csrf @method('PUT')
            @if($errors->any())
            <div class="bg-red-500/10 border border-red-500/30 rounded-xl p-4">
                @foreach($errors->all() as $e)<p class="text-red-400 text-sm">• {{ $e }}</p>@endforeach
            </div>
            @endif
            <div>
                <label class="block text-sm text-slate-300 mb-2">Module</label>
                <select name="module_id" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-emerald-500">
                    @foreach($modules as $m)
                    <option value="{{ $m->id }}" {{ $lecon->module_id == $m->id ? 'selected' : '' }}>{{ $m->titre }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm text-slate-300 mb-2">Titre *</label>
                <input type="text" name="titre" value="{{ old('titre', $lecon->titre) }}" required class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-emerald-500">
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-slate-300 mb-2">Ordre</label>
                    <input type="number" name="ordre" value="{{ old('ordre', $lecon->ordre) }}" min="1" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-emerald-500">
                </div>
                <div>
                    <label class="block text-sm text-slate-300 mb-2">Durée (minutes)</label>
                    <input type="number" name="duree_minutes" value="{{ old('duree_minutes', $lecon->duree_minutes) }}" min="1" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-emerald-500">
                </div>
            </div>
            <div>
                <label class="block text-sm text-slate-300 mb-2">Contenu (HTML) *</label>
                <textarea name="contenu" rows="10" required class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-emerald-500 font-mono text-sm resize-y">{{ old('contenu', $lecon->contenu) }}</textarea>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('encadreur.cours') }}" class="flex-1 text-center border border-slate-600 text-slate-300 font-semibold py-3 rounded-xl transition-colors hover:border-slate-500">Annuler</a>
                <button type="submit" class="flex-1 bg-emerald-500 hover:bg-emerald-400 text-slate-900 font-bold py-3 rounded-xl transition-colors">Sauvegarder</button>
            </div>
        </form>
    </div>
</div>
@endsection
