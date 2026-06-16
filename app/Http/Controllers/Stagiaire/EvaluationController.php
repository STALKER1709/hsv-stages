<?php
namespace App\Http\Controllers\Stagiaire;
use App\Http\Controllers\Controller;
use App\Models\Evaluation;
use App\Models\Resultat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EvaluationController extends Controller
{
    public function show(Evaluation $evaluation)
    {
        $evaluation->load('module', 'questions.reponses');
        $stagiaire = Auth::user()->stagiaire;
        $resultat  = $stagiaire->resultats()->where('evaluation_id', $evaluation->id)->first();
        return view('stagiaire.evaluation', compact('evaluation', 'resultat'));
    }

    public function submit(Request $request, Evaluation $evaluation)
    {
        $evaluation->load('questions.reponses');
        $stagiaire = Auth::user()->stagiaire;

        $score = 0;
        $total = $evaluation->questions->count();

        foreach ($evaluation->questions as $question) {
            $reponseId = $request->input('reponse_' . $question->id);
            $bonne     = $question->reponses->where('id', $reponseId)->where('est_correcte', true)->first();
            if ($bonne) $score++;
        }

        $note = $total > 0 ? round(($score / $total) * 20, 2) : 0;

        Resultat::updateOrCreate(
            ['stagiaire_id' => $stagiaire->id, 'evaluation_id' => $evaluation->id],
            ['score' => $note, 'reponses_json' => $request->only(array_map(fn($q) => 'reponse_' . $q->id, $evaluation->questions->all()))]
        );

        return redirect()->route('stagiaire.evaluation', $evaluation)->with('success', "Évaluation soumise ! Note : {$note}/20");
    }
}
