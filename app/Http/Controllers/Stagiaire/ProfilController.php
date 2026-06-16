<?php
namespace App\Http\Controllers\Stagiaire;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function show()
    {
        $user      = Auth::user();
        $stagiaire = $user->stagiaire()->with(['pole', 'paiement'])->first();
        return view('stagiaire.profil', compact('user', 'stagiaire'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'telephone' => 'required|string|max:20',
            'whatsapp'  => 'nullable|string|max:20',
        ]);
        $user->update([
            'telephone' => $request->telephone,
            'whatsapp'  => $request->whatsapp ?? $request->telephone,
        ]);
        return back()->with('success', 'Profil mis à jour.');
    }

    public function password(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:6|confirmed',
        ]);
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Mot de passe actuel incorrect.']);
        }
        Auth::user()->update(['password' => Hash::make($request->password)]);
        return back()->with('success', 'Mot de passe modifié.');
    }
}
