<footer class="bg-slate-950 border-t border-slate-800 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-9 h-9 bg-gradient-to-br from-emerald-400 to-emerald-600 rounded-xl flex items-center justify-center font-bold text-slate-900">H</div>
                    <span class="font-bold text-white text-lg">HSV <span class="text-emerald-400">Stages</span></span>
                </div>
                <p class="text-slate-400 text-sm leading-relaxed">Plateforme de stages académiques en informatique. Formation de qualité pour les étudiants camerounais.</p>
            </div>
            <div>
                <h3 class="font-semibold text-white mb-4">Liens rapides</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('home') }}" class="text-slate-400 hover:text-emerald-400 transition-colors">Accueil</a></li>
                    <li><a href="{{ route('programme') }}" class="text-slate-400 hover:text-emerald-400 transition-colors">Programme</a></li>
                    <li><a href="{{ route('inscription') }}" class="text-slate-400 hover:text-emerald-400 transition-colors">S'inscrire</a></li>
                    <li><a href="{{ route('login') }}" class="text-slate-400 hover:text-emerald-400 transition-colors">Connexion</a></li>
                </ul>
            </div>
            <div>
                <h3 class="font-semibold text-white mb-4">Contact</h3>
                <ul class="space-y-2 text-sm text-slate-400">
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        contact@hsv-stages.cm
                    </li>
                    <li class="flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-400 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm5.562 16.905c-.26.733-1.277 1.354-2.097 1.529-.558.116-1.286.208-3.738-.804-3.14-1.305-5.167-4.493-5.322-4.703-.154-.21-1.297-1.723-1.297-3.288s.808-2.327 1.121-2.653c.312-.327.68-.409.907-.409.227 0 .455.002.654.012.215.012.504-.082.789.602.293.704 1.001 2.435.1.09.307.161.613.233.613.233z"/></svg>
                        WhatsApp : +237 6XX XXX XXX
                    </li>
                    <li>Yaoundé, Cameroun</li>
                </ul>
            </div>
        </div>
        <div class="border-t border-slate-800 pt-6 text-center text-sm text-slate-500">
            © {{ date('Y') }} HSV Stages. Tous droits réservés. Plateforme dédiée aux stagiaires en informatique.
        </div>
    </div>
</footer>
