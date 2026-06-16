<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Encadreur;
use App\Models\User;
use App\Models\Pole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EncadreurController extends Controller
{
    public function index()
    {
        $encadreurs = Encadreur::with(['user', 'pole'])->paginate(15);
        return view('admin.encadreurs', compact('encadreurs'));
    }

    public function create()
    {
        $poles = Pole::all();
        return view('admin.encadreur-create', compact('poles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom'       => 'required|string|max:100',
            'prenom'    => 'required|string|max:100',
            'email'     => 'required|email|unique:users,email',
            'telephone' => 'required|string|max:20',
            'specialite'=> 'required|string|max:150',
            'pole_id'   => 'required|exists:poles,id',
        ]);
        $user = User::create([
            'name'      => $request->prenom . ' ' . strtoupper($request->nom),
            'email'     => $request->email,
            'password'  => Hash::make($request->telephone),
            'role'      => 'encadreur',
            'telephone' => $request->telephone,
        ]);
        Encadreur::create([
            'user_id'    => $user->id,
            'pole_id'    => $request->pole_id,
            'specialite' => $request->specialite,
        ]);
        return redirect()->route('admin.encadreurs')->with('success', 'Encadreur créé.');
    }

    public function destroy(Encadreur $encadreur)
    {
        $encadreur->user->delete();
        return back()->with('success', 'Encadreur supprimé.');
    }
}
