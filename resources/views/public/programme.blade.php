@extends('layouts.app')
@section('title', 'Programme')
@section('content')
<div class="pt-16 min-h-screen bg-gradient-to-br from-slate-950 to-slate-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-white mb-4">Programme de formation</h1>
            <p class="text-slate-400 max-w-2xl mx-auto">10 semaines de formation intensive, structurées en modules progressifs avec évaluations et certification finale.</p>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            @foreach($poles as $pole)
            <div class="bg-slate-800/50 border border-slate-700/50 rounded-2xl overflow-hidden">
                <div class="p-6 border-b border-slate-700/50" style="background: linear-gradient(135deg, {{ $pole->couleur ?? '#10b981' }}20, transparent)">
                    <h2 class="text-xl font-bold text-white">{{ $pole->nom }}</h2>
                    <p class="text-slate-400 text-sm mt-1">{{ $pole->description }}</p>
                </div>
                <div class="p-6 space-y-3">
                    @foreach($pole->modules->sortBy('ordre') as $module)
                    <div class="flex gap-3">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0 text-sm font-bold text-slate-900" style="background-color: {{ $pole->couleur ?? '#10b981' }}">
                            {{ $module->ordre }}
                        </div>
                        <div>
                            <div class="text-sm font-medium text-white">{{ $module->titre }}</div>
                            <div class="text-xs text-slate-500">{{ $module->duree_semaines }} semaine(s)</div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="px-6 pb-6">
                    <a href="{{ route('inscription') }}" class="block text-center bg-emerald-500 hover:bg-emerald-400 text-slate-900 font-bold py-3 rounded-xl transition-colors">
                        Choisir ce pôle
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
