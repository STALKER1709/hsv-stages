<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    const METHODE_ORANGE  = 'orange_money';
    const METHODE_MTN     = 'mtn_momo';
    const METHODE_ESPECES = 'especes';

    const STATUT_EN_ATTENTE = 'en_attente';
    const STATUT_VALIDE     = 'valide';
    const STATUT_REFUSE     = 'refuse';

    const MONTANT_FCFA = 50000;

    protected $fillable = [
        'stagiaire_id', 'montant', 'methode', 'statut',
        'reference', 'numero_telephone', 'preuve_paiement', 'valide_le', 'valide_par',
    ];

    protected $casts = ['valide_le' => 'datetime'];

    public function stagiaire()  { return $this->belongsTo(Stagiaire::class); }
    public function validePar()  { return $this->belongsTo(User::class, 'valide_par'); }

    public function montantFormate(): string
    {
        return number_format($this->montant, 0, ',', ' ') . ' FCFA';
    }
}
