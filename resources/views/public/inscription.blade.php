@extends('layouts.app')
@section('title', 'Inscription')
@section('content')
<div class="pt-16 min-h-screen bg-gradient-to-br from-slate-950 to-slate-900">
    <div class="max-w-2xl mx-auto px-4 py-16" x-data="{
        step: 1,
        methode: '',
        goTo(s) { this.step = s; window.scrollTo(0,0); }
    }">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-white mb-2">Inscription au stage</h1>
            <p class="text-slate-400">Remplissez le formulaire pour rejoindre la prochaine promotion</p>
        </div>
        <!-- Steps indicator -->
        <div class="flex items-center justify-center gap-4 mb-8">
            <template x-for="i in 3" :key="i">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold transition-all"
                         :class="step >= i ? 'bg-emerald-500 text-slate-900' : 'bg-slate-700 text-slate-400'">
                        <span x-text="i"></span>
                    </div>
                    <template x-if="i < 3"><div class="w-12 h-px" :class="step > i ? 'bg-emerald-500' : 'bg-slate-700'"></div></template>
                </div>
            </template>
        </div>
        <div class="bg-slate-800/50 border border-slate-700/50 rounded-2xl p-8">
            @if($errors->any())
                <div class="bg-red-500/10 border border-red-500/30 rounded-xl p-4 mb-6">
                    @foreach($errors->all() as $error)
                        <p class="text-red-400 text-sm">• {{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <form method="POST" action="{{ route('inscription.store') }}" enctype="multipart/form-data">
                @csrf
                <!-- Step 1: Personal Info -->
                <div x-show="step === 1">
                    <h2 class="text-lg font-bold text-white mb-6">1. Informations personnelles</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm text-slate-300 mb-2">Nom *</label>
                            <input type="text" name="nom" value="{{ old('nom') }}" required class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500" placeholder="DUPONT">
                        </div>
                        <div>
                            <label class="block text-sm text-slate-300 mb-2">Prénom *</label>
                            <input type="text" name="prenom" value="{{ old('prenom') }}" required class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500" placeholder="Jean">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm text-slate-300 mb-2">Email *</label>
                        <input type="email" name="email" value="{{ old('email') }}" required class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500" placeholder="vous@exemple.cm">
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                        <div>
                            <label class="block text-sm text-slate-300 mb-2">Téléphone *</label>
                            <input type="text" name="telephone" value="{{ old('telephone') }}" required class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500" placeholder="+237 6XX XXX XXX">
                        </div>
                        <div>
                            <label class="block text-sm text-slate-300 mb-2">WhatsApp</label>
                            <input type="text" name="whatsapp" value="{{ old('whatsapp') }}" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500" placeholder="+237 6XX XXX XXX">
                        </div>
                    </div>
                    <button type="button" @click="goTo(2)" class="w-full bg-emerald-500 hover:bg-emerald-400 text-slate-900 font-bold py-3 rounded-xl transition-colors">Étape suivante →</button>
                </div>
                <!-- Step 2: Academic Info -->
                <div x-show="step === 2">
                    <h2 class="text-lg font-bold text-white mb-6">2. Informations académiques</h2>
                    <div class="mb-4">
                        <label class="block text-sm text-slate-300 mb-2">Établissement *</label>
                        <select name="etablissement" required class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-emerald-500">
                            <option value="">Sélectionnez votre établissement</option>
                            @foreach(\App\Models\Stagiaire::ETABLISSEMENTS as $key => $label)
                                <option value="{{ $key }}" {{ old('etablissement') == $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm text-slate-300 mb-2">Filière *</label>
                        <input type="text" name="filiere" value="{{ old('filiere') }}" required class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500" placeholder="Informatique, Génie Logiciel...">
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm text-slate-300 mb-2">Niveau *</label>
                        <div class="grid grid-cols-5 gap-2">
                            @foreach(['L1','L2','L3','M1','M2'] as $niv)
                            <label class="cursor-pointer">
                                <input type="radio" name="niveau" value="{{ $niv }}" {{ old('niveau') == $niv ? 'checked' : '' }} class="sr-only peer">
                                <div class="text-center py-3 border border-slate-700 rounded-xl text-sm font-medium text-slate-400 peer-checked:bg-emerald-500 peer-checked:text-slate-900 peer-checked:border-emerald-500 hover:border-emerald-500/50 transition-all cursor-pointer">{{ $niv }}</div>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <button type="button" @click="goTo(1)" class="flex-1 border border-slate-600 hover:border-slate-500 text-slate-300 font-semibold py-3 rounded-xl transition-colors">← Retour</button>
                        <button type="button" @click="goTo(3)" class="flex-1 bg-emerald-500 hover:bg-emerald-400 text-slate-900 font-bold py-3 rounded-xl transition-colors">Étape suivante →</button>
                    </div>
                </div>
                <!-- Step 3: Pole + Payment -->
                <div x-show="step === 3">
                    <h2 class="text-lg font-bold text-white mb-6">3. Pôle & Paiement</h2>
                    <div class="mb-4">
                        <label class="block text-sm text-slate-300 mb-2">Pôle de formation *</label>
                        <div class="space-y-3">
                            @foreach($poles as $pole)
                            <label class="cursor-pointer block">
                                <input type="radio" name="pole_id" value="{{ $pole->id }}" {{ old('pole_id') == $pole->id ? 'checked' : '' }} class="sr-only peer">
                                <div class="border border-slate-700 rounded-xl p-4 peer-checked:border-emerald-500 peer-checked:bg-emerald-500/5 hover:border-emerald-500/50 transition-all">
                                    <div class="font-medium text-white">{{ $pole->nom }}</div>
                                    <div class="text-xs text-slate-400 mt-1">{{ $pole->description }}</div>
                                </div>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm text-slate-300 mb-2">Mode de paiement *</label>
                        <div class="grid grid-cols-3 gap-3">
                            <label class="cursor-pointer">
                                <input type="radio" name="paiement" value="orange_money" x-model="methode" class="sr-only peer">
                                <div class="text-center p-3 border border-slate-700 rounded-xl peer-checked:border-orange-500 peer-checked:bg-orange-500/10 hover:border-orange-500/50 transition-all cursor-pointer">
                                    <div class="text-orange-400 font-bold text-sm">Orange</div>
                                    <div class="text-xs text-slate-400">Money</div>
                                </div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="radio" name="paiement" value="mtn_momo" x-model="methode" class="sr-only peer">
                                <div class="text-center p-3 border border-slate-700 rounded-xl peer-checked:border-yellow-500 peer-checked:bg-yellow-500/10 hover:border-yellow-500/50 transition-all cursor-pointer">
                                    <div class="text-yellow-400 font-bold text-sm">MTN</div>
                                    <div class="text-xs text-slate-400">MoMo</div>
                                </div>
                            </label>
                            <label class="cursor-pointer">
                                <input type="radio" name="paiement" value="especes" x-model="methode" class="sr-only peer">
                                <div class="text-center p-3 border border-slate-700 rounded-xl peer-checked:border-emerald-500 peer-checked:bg-emerald-500/10 hover:border-emerald-500/50 transition-all cursor-pointer">
                                    <div class="text-emerald-400 font-bold text-sm">Cash</div>
                                    <div class="text-xs text-slate-400">Espèces</div>
                                </div>
                            </label>
                        </div>
                    </div>
                    <div x-show="methode && methode !== 'especes'" class="mb-4">
                        <label class="block text-sm text-slate-300 mb-2">Numéro de paiement</label>
                        <input type="text" name="numero_paiement" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500" placeholder="+237 6XX XXX XXX">
                    </div>
                    <div x-show="methode && methode !== 'especes'" class="mb-4">
                        <label class="block text-sm text-slate-300 mb-2">Capture d'écran du paiement</label>
                        <input type="file" name="preuve_paiement" accept="image/*" class="w-full text-sm text-slate-300 bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 focus:outline-none focus:border-emerald-500 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:bg-emerald-500 file:text-slate-900 file:font-semibold">
                        <p class="text-xs text-slate-500 mt-2">
                            Pas de capture sous la main ? Envoyez-la directement sur
                            <a href="{{ \App\Support\WhatsAppLink::make(config('services.contact.whatsapp_number'), 'Bonjour, je viens de faire le paiement de mon inscription au stage HSV Stages, voici ma preuve de paiement :') }}" target="_blank" rel="noopener" class="text-emerald-400 hover:underline">WhatsApp</a>.
                        </p>
                    </div>
                    <div class="bg-emerald-500/10 border border-emerald-500/20 rounded-xl p-4 mb-6">
                        <div class="flex justify-between items-center">
                            <span class="text-slate-300 text-sm">Frais d'inscription</span>
                            <span class="font-bold text-white text-xl">50 000 FCFA</span>
                        </div>
                    </div>
                    <div class="flex gap-3">
                        <button type="button" @click="goTo(2)" class="flex-1 border border-slate-600 text-slate-300 font-semibold py-3 rounded-xl transition-colors">← Retour</button>
                        <button type="submit" class="flex-1 bg-emerald-500 hover:bg-emerald-400 text-slate-900 font-bold py-3 rounded-xl transition-colors">Confirmer l'inscription ✓</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
