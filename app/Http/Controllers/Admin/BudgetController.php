<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Paiement;
use App\Models\Stagiaire;

class BudgetController extends Controller
{
    public function index()
    {
        $paiements = Paiement::with('stagiaire.user')->latest()->paginate(20);
        $stats = [
            'recettes_total'       => Paiement::where('statut', 'valide')->sum('montant'),
            'recettes_attendues'   => Stagiaire::where('statut', 'valide')->count() * \App\Models\Paiement::MONTANT_FCFA,
            'paiements_valides'    => Paiement::where('statut', 'valide')->count(),
            'paiements_attente'    => Paiement::where('statut', 'en_attente')->count(),
            'depenses_rh'          => 1200000,
            'depenses_comm'        => 350000,
            'depenses_logistique'  => 500000,
            'depenses_mobilier'    => 300000,
            'depenses_imprevus'    => 215000,
        ];
        $stats['depenses_total'] = array_sum(array_filter($stats, fn($k) => str_starts_with($k, 'depenses_'), ARRAY_FILTER_USE_KEY));
        $stats['solde']          = $stats['recettes_total'] - $stats['depenses_total'];
        return view('admin.budget', compact('paiements', 'stats'));
    }

    public function validerPaiement(\App\Models\Paiement $paiement)
    {
        $paiement->update(['statut' => 'valide']);
        return back()->with('success', 'Paiement validé.');
    }
}
