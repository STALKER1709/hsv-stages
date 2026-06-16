<?php

namespace App\Http\Controllers;

use App\Models\Pole;
use App\Models\Paiement;
use App\Models\Stagiaire;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class InscriptionController extends Controller
{
    public function showForm()
    {
        $poles = Pole::all();
        return view('public.inscription', compact('poles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom'            => 'required|string|max:100',
            'prenom'         => 'required|string|max:100',
            'email'          => 'required|email|unique:users,email',
            'telephone'      => 'required|string|max:20',
            'whatsapp'       => 'nullable|string|max:20',
            'etablissement'  => 'required|string',
            'filiere'        => 'required|string|max:150',
            'niveau'         => 'required|in:L1,L2,L3,M1,M2',
            'pole_id'        => 'required|exists:poles,id',
            'paiement'       => 'required|in:orange_money,mtn_momo,especes',
            'numero_paiement'=> 'nullable|string|max:20',
        ]);

        DB::transaction(function () use ($request) {
            $user = User::create([
                'name'      => $request->prenom . ' ' . strtoupper($request->nom),
                'email'     => $request->email,
                'password'  => Hash::make(substr($request->telephone, -6)),
                'role'      => 'stagiaire',
                'telephone' => $request->telephone,
                'whatsapp'  => $request->whatsapp ?? $request->telephone,
            ]);

            $stagiaire = Stagiaire::create([
                'user_id'       => $user->id,
                'pole_id'       => $request->pole_id,
                'etablissement' => $request->etablissement,
                'filiere'       => $request->filiere,
                'niveau'        => $request->niveau,
                'statut'        => 'en_attente',
            ]);

            Paiement::create([
                'stagiaire_id'     => $stagiaire->id,
                'montant'          => Paiement::MONTANT_FCFA,
                'methode'          => $request->paiement,
                'statut'           => 'en_attente',
                'numero_telephone' => $request->numero_paiement ?? $request->telephone,
            ]);
        });

        return redirect()->route('login')->with('success',
            'Inscription enregistrée ! Connectez-vous avec votre email. Mot de passe = 6 derniers chiffres de votre téléphone.'
        );
    }
}
