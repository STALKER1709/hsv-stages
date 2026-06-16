<?php

namespace App\Http\Controllers\Stagiaire;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user      = Auth::user();
        $stagiaire = $user->stagiaire()->with(['pole.modules.lecons', 'resultats', 'presences', 'paiement'])->first();

        $stats = [
            'modules_completes'  => $stagiaire?->resultats()->whereNotNull('score')->distinct('evaluation_id')->count() ?? 0,
            'modules_total'      => $stagiaire?->pole?->modules?->count() ?? 0,
            'evals_passees'      => $stagiaire?->resultats()->whereNotNull('score')->count() ?? 0,
            'evals_total'        => $stagiaire?->pole?->modules?->sum(fn($m) => $m->evaluations->count()) ?? 0,
            'taux_presence'      => $stagiaire?->tauxPresence() ?? 0,
            'progression'        => $stagiaire?->progressionGlobale() ?? 0,
            'moyenne'            => $stagiaire?->moyenneGenerale() ?? 0,
            'jours_restants'     => now()->diffInDays('2025-09-30', false),
        ];

        $moduleEnCours = $stagiaire?->pole?->modules?->first();

        return view('stagiaire.dashboard', compact('user', 'stagiaire', 'stats', 'moduleEnCours'));
    }
}
