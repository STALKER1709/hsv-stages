<?php
namespace Database\Seeders;
use App\Models\User;
use App\Models\Stagiaire;
use App\Models\Encadreur;
use App\Models\Pole;
use App\Models\Paiement;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name'      => 'Coordinateur HSV',
            'email'     => 'admin@hsv-stages.cm',
            'password'  => Hash::make('admin123'),
            'role'      => 'admin',
            'telephone' => '690000000',
        ]);

        $poles = Pole::all();

        // Encadreurs (1 per pole)
        $encadreurs = [
            ['nom' => 'Jean-Baptiste MBARGA', 'email' => 'mbarga@hsv-stages.cm', 'specialite' => 'Développement Web & Mobile'],
            ['nom' => 'Christelle FOUDA',     'email' => 'fouda@hsv-stages.cm',  'specialite' => 'Réseaux & Cybersécurité'],
            ['nom' => 'Patrick NKEMDIRIM',    'email' => 'nkemdirim@hsv-stages.cm', 'specialite' => 'Architecture & DevOps'],
        ];
        foreach ($poles as $i => $pole) {
            if (!isset($encadreurs[$i])) continue;
            $ed   = $encadreurs[$i];
            $user = User::create([
                'name'      => $ed['nom'],
                'email'     => $ed['email'],
                'password'  => Hash::make('encadreur123'),
                'role'      => 'encadreur',
                'telephone' => '69100000' . ($i + 1),
            ]);
            Encadreur::create(['user_id' => $user->id, 'pole_id' => $pole->id, 'specialite' => $ed['specialite']]);
        }

        // Sample stagiaires
        $etablissements = ['IAI', 'ISSAM', 'SIANTOU', 'ISESTMA'];
        $filieres = ['Informatique', 'Génie Logiciel', 'Réseaux & Télécoms', 'Software Engineering'];
        $niveaux  = ['L1', 'L2', 'L3', 'M1', 'M2'];
        $statuts  = ['valide', 'valide', 'valide', 'en_attente'];

        $firstPole = $poles->first();
        for ($i = 1; $i <= 5; $i++) {
            $phone = '67' . str_pad($i, 8, '0', STR_PAD_LEFT);
            $user  = User::create([
                'name'      => "Stagiaire Test $i",
                'email'     => "stagiaire$i@test.cm",
                'password'  => Hash::make(substr($phone, -6)),
                'role'      => 'stagiaire',
                'telephone' => $phone,
            ]);
            $statut    = $statuts[array_rand($statuts)];
            $stagiaire = Stagiaire::create([
                'user_id'       => $user->id,
                'pole_id'       => $poles->random()->id,
                'etablissement' => $etablissements[array_rand($etablissements)],
                'filiere'       => $filieres[array_rand($filieres)],
                'niveau'        => $niveaux[array_rand($niveaux)],
                'statut'        => $statut,
            ]);
            Paiement::create([
                'stagiaire_id'     => $stagiaire->id,
                'montant'          => Paiement::MONTANT_FCFA,
                'methode'          => ['orange_money', 'mtn_momo', 'especes'][array_rand(['orange_money', 'mtn_momo', 'especes'])],
                'statut'           => $statut === 'valide' ? 'valide' : 'en_attente',
                'numero_telephone' => $phone,
            ]);
        }
    }
}
