@extends('layouts.app')
@section('title', 'Connexion')
@section('content')
<div class="min-h-screen pt-16 flex items-center justify-center px-4 bg-gradient-to-br from-slate-950 via-slate-900 to-slate-950">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-gradient-to-br from-emerald-400 to-emerald-600 rounded-2xl flex items-center justify-center font-bold text-slate-900 text-2xl mx-auto mb-4">H</div>
            <h1 class="text-2xl font-bold text-white">Bienvenue</h1>
            <p class="text-slate-400 text-sm mt-1">Connectez-vous à votre espace HSV Stages</p>
        </div>
        <div class="bg-slate-800/50 backdrop-blur border border-slate-700/50 rounded-2xl p-8">
            @if($errors->any())
                <div class="bg-red-500/10 border border-red-500/30 rounded-xl p-4 mb-6">
                    @foreach($errors->all() as $error)
                        <p class="text-red-400 text-sm">{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <form method="POST" action="{{ route('login.post') }}" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Adresse email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                           class="w-full bg-slate-900/80 border border-slate-700 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors"
                           placeholder="vous@exemple.cm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-300 mb-2">Mot de passe</label>
                    <input type="password" name="password" required
                           class="w-full bg-slate-900/80 border border-slate-700 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors"
                           placeholder="••••••••">
                    <p class="text-xs text-slate-500 mt-1">Mot de passe par défaut : 6 derniers chiffres de votre téléphone</p>
                </div>
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="remember" id="remember" class="rounded border-slate-600 bg-slate-800 text-emerald-500 focus:ring-emerald-500">
                    <label for="remember" class="text-sm text-slate-400">Se souvenir de moi</label>
                </div>
                <button type="submit" class="w-full bg-emerald-500 hover:bg-emerald-400 text-slate-900 font-bold py-3 rounded-xl transition-colors">
                    Se connecter
                </button>
            </form>
            <div class="mt-6 text-center">
                <p class="text-slate-400 text-sm">Pas encore inscrit ?
                    <a href="{{ route('inscription') }}" class="text-emerald-400 hover:text-emerald-300 font-medium">S'inscrire maintenant</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
