@extends('layouts.dashboard')
@section('title', 'Nouvel Encadreur')
@section('role-label', 'Administration')
@section('page-title', 'Ajouter un encadreur')

@section('sidebar-links')
<a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 transition-all">Dashboard</a>
<a href="{{ route('admin.encadreurs') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium bg-emerald-500 text-slate-900 transition-all">Encadreurs</a>
@endsection

@section('content')
<div class="max-w-xl">
    <div class="bg-slate-800/50 border border-slate-700/50 rounded-2xl p-6">
        <form method="POST" action="{{ route('admin.encadreur.store') }}" class="space-y-5">
            @csrf
            @if($errors->any())
            <div class="bg-red-500/10 border border-red-500/30 rounded-xl p-4">
                @foreach($errors->all() as $e)<p class="text-red-400 text-sm">• {{ $e }}</p>@endforeach
            </div>
            @endif
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm text-slate-300 mb-2">Nom *</label>
                    <input type="text" name="nom" value="{{ old('nom') }}" required class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-emerald-500">
                </div>
                <div>
                    <label class="block text-sm text-slate-300 mb-2">Prénom *</label>
                    <input type="text" name="prenom" value="{{ old('prenom') }}" required class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-emerald-500">
                </div>
            </div>
            <div>
                <label class="block text-sm text-slate-300 mb-2">Email *</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-emerald-500">
            </div>
            <div>
                <label class="block text-sm text-slate-300 mb-2">Téléphone *</label>
                <input type="text" name="telephone" value="{{ old('telephone') }}" required class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-emerald-500" placeholder="+237 6XX XXX XXX">
            </div>
            <div>
                <label class="block text-sm text-slate-300 mb-2">Spécialité *</label>
                <input type="text" name="specialite" value="{{ old('specialite') }}" required class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-emerald-500" placeholder="Développement Web, Réseaux...">
            </div>
            <div>
                <label class="block text-sm text-slate-300 mb-2">Pôle *</label>
                <select name="pole_id" required class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-emerald-500">
                    @foreach($poles as $pole)
                    <option value="{{ $pole->id }}" {{ old('pole_id') == $pole->id ? 'selected' : '' }}>{{ $pole->nom }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.encadreurs') }}" class="flex-1 text-center border border-slate-600 text-slate-300 font-semibold py-3 rounded-xl">Annuler</a>
                <button type="submit" class="flex-1 bg-emerald-500 hover:bg-emerald-400 text-slate-900 font-bold py-3 rounded-xl transition-colors">Créer l'encadreur</button>
            </div>
        </form>
    </div>
</div>
@endsection
