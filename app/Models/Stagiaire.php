<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stagiaire extends Model
{
    use HasFactory;

    const STATUT_EN_ATTENTE = 'en_attente';
    const STATUT_VALIDE     = 'valide';
    const STATUT_REFUSE     = 'refuse';

    const ETABLISSEMENTS = [
        'IAI'      => 'IAI Cameroun',
        'ISSAM'    => 'ISSAM',
        'SIANTOU'  => 'Université SIANTOU',
        'ISESTMA'  => 'ISESTMA',
        'AUTRE'    => 'Autre',
    ];

    const NIVEAUX = ['L1','L2','L3','M1','M2'];

    protected $fillable = [
        'user_id', 'pole_id', 'etablissement', 'filiere', 'niveau',
        'statut', 'numero_stagiaire',
    ];

    public function user()       { return $this->belongsTo(User::class); }
    public function pole()       { return $this->belongsTo(Pole::class); }
    public function paiement()   { return $this->hasOne(Paiement::class); }
    public function presences()  { return $this->hasMany(Presence::class); }
    public function resultats()  { return $this->hasMany(Resultat::class); }
    public function attestation(){ return $this->hasOne(Attestation::class); }

    public function progressionGlobale(): float
    {
        $totalLecons = $this->pole?->modules?->sum(fn($m) => $m->lecons->count()) ?? 0;
        if ($totalLecons === 0) return 0;
        $completees = $this->resultats()->whereNotNull('score')->count();
        return round(($completees / $totalLecons) * 100, 1);
    }

    public function moyenneGenerale(): float
    {
        $resultats = $this->resultats()->whereNotNull('score')->get();
        if ($resultats->isEmpty()) return 0;
        return round($resultats->avg('score'), 2);
    }

    public function tauxPresence(): float
    {
        $total = $this->presences()->count();
        if ($total === 0) return 0;
        $presents = $this->presences()->where('statut', 'present')->count();
        return round(($presents / $total) * 100, 1);
    }
}
