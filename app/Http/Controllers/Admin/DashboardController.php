<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Stagiaire;
use App\Models\Encadreur;
use App\Models\Pole;
use App\Models\Paiement;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'stagiaires_total'  => Stagiaire::count(),
            'stagiaires_valides'=> Stagiaire::where('statut', 'valide')->count(),
            'stagiaires_attente'=> Stagiaire::where('statut', 'en_attente')->count(),
            'encadreurs_total'  => Encadreur::count(),
            'poles_total'       => Pole::count(),
            'recettes_total'    => Paiement::where('statut', 'valide')->sum('montant'),
            'paiements_attente' => Paiement::where('statut', 'en_attente')->count(),
        ];
        $poles          = Pole::withCount('stagiaires')->get();
        $derniersStagiaires = Stagiaire::with(['user', 'pole', 'paiement'])->latest()->take(10)->get();
        return view('admin.dashboard', compact('stats', 'poles', 'derniersStagiaires'));
    }
}
