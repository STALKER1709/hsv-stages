<?php
namespace App\Http\Controllers\Encadreur;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $encadreur = Auth::user()->encadreur()->with(['pole.stagiaires.user', 'pole.modules'])->first();
        $stagiaires = $encadreur?->pole?->stagiaires ?? collect();
        $stats = [
            'total_stagiaires' => $stagiaires->count(),
            'stagiaires_valides' => $stagiaires->where('statut', 'valide')->count(),
            'modules_total' => $encadreur?->pole?->modules?->count() ?? 0,
        ];
        return view('encadreur.dashboard', compact('encadreur', 'stagiaires', 'stats'));
    }
}
