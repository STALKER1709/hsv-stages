<?php
namespace App\Http\Controllers\Encadreur;
use App\Http\Controllers\Controller;
use App\Models\Module;
use App\Models\Lecon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoursController extends Controller
{
    public function index()
    {
        $encadreur = Auth::user()->encadreur()->with('pole.modules.lecons')->first();
        $modules   = $encadreur?->pole?->modules ?? collect();
        return view('encadreur.cours', compact('modules'));
    }

    public function create()
    {
        $encadreur = Auth::user()->encadreur()->with('pole.modules')->first();
        $modules   = $encadreur?->pole?->modules ?? collect();
        return view('encadreur.cours-create', compact('modules'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'module_id' => 'required|exists:modules,id',
            'titre'     => 'required|string|max:200',
            'contenu'   => 'required|string',
            'ordre'     => 'required|integer|min:1',
        ]);
        Lecon::create($request->only('module_id', 'titre', 'contenu', 'duree_minutes', 'ordre'));
        return redirect()->route('encadreur.cours')->with('success', 'Leçon créée.');
    }

    public function edit(Lecon $lecon)
    {
        $encadreur = Auth::user()->encadreur()->with('pole.modules')->first();
        $modules   = $encadreur?->pole?->modules ?? collect();
        return view('encadreur.cours-edit', compact('lecon', 'modules'));
    }

    public function update(Request $request, Lecon $lecon)
    {
        $request->validate([
            'titre'   => 'required|string|max:200',
            'contenu' => 'required|string',
        ]);
        $lecon->update($request->only('titre', 'contenu', 'duree_minutes', 'ordre'));
        return redirect()->route('encadreur.cours')->with('success', 'Leçon mise à jour.');
    }

    public function destroy(Lecon $lecon)
    {
        $lecon->delete();
        return back()->with('success', 'Leçon supprimée.');
    }
}
