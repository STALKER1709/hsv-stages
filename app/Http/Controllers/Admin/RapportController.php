<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Stagiaire;
use Symfony\Component\HttpFoundation\StreamedResponse;

class RapportController extends Controller
{
    public function index()
    {
        return view('admin.rapports');
    }

    public function exportStagiaires(): StreamedResponse
    {
        $stagiaires = Stagiaire::with(['user', 'pole', 'paiement'])->get();
        $headers    = ['Content-Type' => 'text/csv; charset=UTF-8', 'Content-Disposition' => 'attachment; filename=stagiaires.csv'];
        return response()->stream(function () use ($stagiaires) {
            $f = fopen('php://output', 'w');
            fputs($f, "\xEF\xBB\xBF");
            fputcsv($f, ['Nom', 'Email', 'Téléphone', 'Pôle', 'Établissement', 'Filière', 'Niveau', 'Statut', 'Paiement'], ';');
            foreach ($stagiaires as $s) {
                fputcsv($f, [$s->user->name, $s->user->email, $s->user->telephone, $s->pole?->nom, $s->etablissement, $s->filiere, $s->niveau, $s->statut, $s->paiement?->statut], ';');
            }
            fclose($f);
        }, 200, $headers);
    }
}
