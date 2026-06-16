<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Stagiaire;
use App\Models\Pole;
use Illuminate\Http\Request;

class StagiaireController extends Controller
{
    public function index(Request $request)
    {
        $query = Stagiaire::with(['user', 'pole', 'paiement']);
        if ($request->filled('statut'))   $query->where('statut', $request->statut);
        if ($request->filled('pole_id'))  $query->where('pole_id', $request->pole_id);
        if ($request->filled('search')) {
            $s = $request->search;
            $query->whereHas('user', fn($q) => $q->where('name', 'like', "%$s%")->orWhere('email', 'like', "%$s%"));
        }
        $stagiaires = $query->paginate(20)->withQueryString();
        $poles      = Pole::all();
        return view('admin.stagiaires', compact('stagiaires', 'poles'));
    }

    public function show(Stagiaire $stagiaire)
    {
        $stagiaire->load(['user', 'pole.modules.evaluations', 'resultats.evaluation', 'presences', 'paiement', 'attestation']);
        return view('admin.stagiaire-detail', compact('stagiaire'));
    }

    public function valider(Stagiaire $stagiaire)
    {
        $stagiaire->update(['statut' => 'valide']);
        if ($stagiaire->paiement) $stagiaire->paiement->update(['statut' => 'valide']);
        return back()->with('success', 'Stagiaire validé.');
    }

    public function rejeter(Stagiaire $stagiaire)
    {
        $stagiaire->update(['statut' => 'rejete']);
        return back()->with('success', 'Stagiaire rejeté.');
    }

    public function genererAttestation(Stagiaire $stagiaire)
    {
        \App\Models\Attestation::updateOrCreate(
            ['stagiaire_id' => $stagiaire->id],
            ['statut' => 'disponible', 'date_emission' => now()->toDateString(), 'delivre_par' => 'HSV Stages']
        );
        return back()->with('success', 'Attestation générée.');
    }
}
