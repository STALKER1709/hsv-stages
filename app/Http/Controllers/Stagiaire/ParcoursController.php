<?php

namespace App\Http\Controllers\Stagiaire;

use App\Http\Controllers\Controller;
use App\Models\Lecon;
use Illuminate\Support\Facades\Auth;

class ParcoursController extends Controller
{
    public function index()
    {
        $stagiaire = Auth::user()->stagiaire()->with('pole.modules.lecons')->first();
        $modules   = $stagiaire?->pole?->modules ?? collect();

        return view('stagiaire.parcours', compact('stagiaire', 'modules'));
    }

    public function cours(Lecon $lecon)
    {
        $lecon->load('module.lecons', 'module.pole');

        $precedente = $lecon->module->lecons->where('ordre', '<', $lecon->ordre)->last();
        $suivante   = $lecon->module->lecons->where('ordre', '>', $lecon->ordre)->first();

        return view('stagiaire.cours', compact('lecon', 'precedente', 'suivante'));
    }
}
