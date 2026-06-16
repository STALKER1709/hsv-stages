@extends('layouts.dashboard')
@section('title', 'Mon Profil')
@section('role-label', 'Espace Stagiaire')
@section('page-title', 'Mon Profil')

@section('sidebar-links')
<a href="{{ route('stagiaire.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 transition-all">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
    Dashboard
</a>
<a href="{{ route('stagiaire.parcours') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 transition-all">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253"/></svg>
    Mon Parcours
</a>
<a href="{{ route('stagiaire.attestation') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium text-slate-400 hover:text-white hover:bg-slate-800 transition-all">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
    Attestation
</a>
<a href="{{ route('stagiaire.profil') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium bg-emerald-500 text-slate-900 transition-all">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
    Mon Profil
</a>
@endsection

@section('content')
<div class="max-w-2xl space-y-6">
    <!-- Info card -->
    <div class="bg-slate-800/50 border border-slate-700/50 rounded-2xl p-6">
        <div class="flex items-center gap-4 mb-6">
            <div class="w-16 h-16 bg-gradient-to-br from-emerald-400 to-emerald-600 rounded-2xl flex items-center justify-center text-2xl font-bold text-slate-900">
                {{ strtoupper(substr($user->name, 0, 1)) }}
            </div>
            <div>
                <h2 class="text-xl font-bold text-white">{{ $user->name }}</h2>
                <p class="text-slate-400 text-sm">{{ $stagiaire?->pole?->nom ?? 'Pôle non assigné' }}</p>
                <span class="inline-block mt-1 text-xs px-2 py-0.5 rounded-full {{ $stagiaire?->statut === 'valide' ? 'bg-emerald-500/20 text-emerald-400' : 'bg-yellow-500/20 text-yellow-400' }}">
                    {{ $stagiaire?->statut === 'valide' ? 'Validé' : 'En attente' }}
                </span>
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4 text-sm">
            <div><span class="text-slate-500">Email</span><div class="text-white mt-0.5">{{ $user->email }}</div></div>
            <div><span class="text-slate-500">Établissement</span><div class="text-white mt-0.5">{{ \App\Models\Stagiaire::ETABLISSEMENTS[$stagiaire?->etablissement] ?? $stagiaire?->etablissement }}</div></div>
            <div><span class="text-slate-500">Filière</span><div class="text-white mt-0.5">{{ $stagiaire?->filiere }}</div></div>
            <div><span class="text-slate-500">Niveau</span><div class="text-white mt-0.5">{{ $stagiaire?->niveau }}</div></div>
        </div>
    </div>
    <!-- Update contact -->
    <div class="bg-slate-800/50 border border-slate-700/50 rounded-2xl p-6">
        <h3 class="font-bold text-white mb-4">Modifier le contact</h3>
        <form method="POST" action="{{ route('stagiaire.profil.update') }}" class="space-y-4">
            @csrf @method('PUT')
            <div>
                <label class="block text-sm text-slate-400 mb-2">Téléphone</label>
                <input type="text" name="telephone" value="{{ $user->telephone }}" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
            </div>
            <div>
                <label class="block text-sm text-slate-400 mb-2">WhatsApp</label>
                <input type="text" name="whatsapp" value="{{ $user->whatsapp }}" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
            </div>
            <button type="submit" class="bg-emerald-500 hover:bg-emerald-400 text-slate-900 font-bold px-6 py-2.5 rounded-xl transition-colors">Sauvegarder</button>
        </form>
    </div>
    <!-- Password -->
    <div class="bg-slate-800/50 border border-slate-700/50 rounded-2xl p-6">
        <h3 class="font-bold text-white mb-4">Changer le mot de passe</h3>
        <form method="POST" action="{{ route('stagiaire.profil.password') }}" class="space-y-4">
            @csrf @method('PUT')
            <div>
                <label class="block text-sm text-slate-400 mb-2">Mot de passe actuel</label>
                <input type="password" name="current_password" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
                @error('current_password')<p class="text-red-400 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm text-slate-400 mb-2">Nouveau mot de passe</label>
                <input type="password" name="password" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
            </div>
            <div>
                <label class="block text-sm text-slate-400 mb-2">Confirmer</label>
                <input type="password" name="password_confirmation" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500">
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-400 text-white font-bold px-6 py-2.5 rounded-xl transition-colors">Changer le mot de passe</button>
        </form>
    </div>
    <!-- Paiement -->
    @if($stagiaire?->paiement)
    <div class="bg-slate-800/50 border border-slate-700/50 rounded-2xl p-6">
        <h3 class="font-bold text-white mb-4">Paiement</h3>
        <div class="flex items-center justify-between">
            <div>
                <div class="text-white font-bold text-xl">{{ $stagiaire->paiement->montantFormate() }}</div>
                <div class="text-slate-400 text-sm mt-0.5">{{ ucfirst(str_replace('_', ' ', $stagiaire->paiement->methode)) }}</div>
            </div>
            <span class="px-3 py-1 rounded-full text-sm {{ $stagiaire->paiement->statut === 'valide' ? 'bg-emerald-500/20 text-emerald-400' : 'bg-yellow-500/20 text-yellow-400' }}">
                {{ $stagiaire->paiement->statut === 'valide' ? '✓ Validé' : '⏳ En attente' }}
            </span>
        </div>
    </div>
    @endif
</div>
@endsection
