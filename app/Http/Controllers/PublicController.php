<?php

namespace App\Http\Controllers;

use App\Models\Pole;
use App\Models\Stagiaire;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        $poles = Pole::withCount('stagiaires')->get();
        $totalStagiaires = Stagiaire::where('statut', 'valide')->count();
        return view('public.index', compact('poles', 'totalStagiaires'));
    }

    public function programme()
    {
        $poles = Pole::with('modules')->get();
        return view('public.programme', compact('poles'));
    }
}
