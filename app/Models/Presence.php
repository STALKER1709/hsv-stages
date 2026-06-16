<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presence extends Model
{
    use HasFactory;

    const STATUT_PRESENT = 'present';
    const STATUT_ABSENT  = 'absent';
    const STATUT_RETARD  = 'retard';

    protected $fillable = ['stagiaire_id', 'encadreur_id', 'date', 'statut', 'remarque'];

    protected $casts = ['date' => 'date'];

    public function stagiaire()  { return $this->belongsTo(Stagiaire::class); }
    public function encadreur()  { return $this->belongsTo(Encadreur::class); }
}
