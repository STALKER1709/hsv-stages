<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attestation extends Model
{
    use HasFactory;

    protected $fillable = [
        'stagiaire_id', 'numero', 'generee_le', 'validee_par', 'mention', 'fichier_pdf',
    ];

    protected $casts = ['generee_le' => 'datetime'];

    public function stagiaire()  { return $this->belongsTo(Stagiaire::class); }
    public function valideePar() { return $this->belongsTo(User::class, 'validee_par'); }
}
