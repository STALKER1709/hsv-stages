<?php
namespace App\Http\Controllers\Encadreur;
use App\Http\Controllers\Controller;
use App\Models\Presence;
use App\Models\Stagiaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PresenceController extends Controller
{
    public function index()
    {
        $encadreur  = Auth::user()->encadreur()->with('pole')->first();
        $stagiaires = Stagiaire::where('pole_id', $encadreur?->pole_id)->with(['user', 'presences'])->get();
        $today      = now()->toDateString();
        return view('encadreur.presences', compact('stagiaires', 'today'));
    }

    public function store(Request $request)
    {
        $request->validate(['date' => 'required|date', 'presences' => 'array']);
        $encadreur  = Auth::user()->encadreur;
        $stagiaires = Stagiaire::where('pole_id', $encadreur?->pole_id)->pluck('id');
        foreach ($stagiaires as $stagiaireId) {
            Presence::updateOrCreate(
                ['stagiaire_id' => $stagiaireId, 'date' => $request->date],
                ['present' => in_array($stagiaireId, $request->presences ?? []), 'enregistre_par' => Auth::id()]
            );
        }
        return back()->with('success', 'Présences enregistrées.');
    }
}
