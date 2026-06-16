<?php
namespace App\Http\Controllers\Encadreur;
use App\Http\Controllers\Controller;
use App\Models\Stagiaire;
use Illuminate\Support\Facades\Auth;

class StagiaireController extends Controller
{
    public function index()
    {
        $encadreur  = Auth::user()->encadreur()->with('pole')->first();
        $stagiaires = Stagiaire::where('pole_id', $encadreur?->pole_id)
                               ->with(['user', 'resultats', 'presences'])
                               ->paginate(20);
        return view('encadreur.stagiaires', compact('stagiaires'));
    }

    public function show(Stagiaire $stagiaire)
    {
        $stagiaire->load(['user', 'pole.modules.evaluations', 'resultats.evaluation', 'presences']);
        return view('encadreur.stagiaire-detail', compact('stagiaire'));
    }
}
