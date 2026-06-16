<?php
namespace App\Http\Controllers\Stagiaire;
use App\Http\Controllers\Controller;
use App\Models\Attestation;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class AttestationController extends Controller
{
    public function index()
    {
        $stagiaire   = Auth::user()->stagiaire()->with('pole')->first();
        $attestation = $stagiaire?->attestation;
        return view('stagiaire.attestation', compact('stagiaire', 'attestation'));
    }

    public function download()
    {
        $stagiaire = Auth::user()->stagiaire()->with(['pole', 'user'])->first();
        $attestation = $stagiaire->attestation;
        if (!$attestation || $attestation->statut !== 'disponible') {
            return back()->with('error', 'Attestation non disponible.');
        }
        $pdf = Pdf::loadView('pdf.attestation', compact('stagiaire', 'attestation'))
                  ->setPaper('a4', 'landscape');
        return $pdf->download('attestation-' . $stagiaire->user->name . '.pdf');
    }
}
