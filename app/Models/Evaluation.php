<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    const TYPE_QCM          = 'qcm';
    const TYPE_PROJET       = 'projet';
    const TYPE_SOUTENANCE   = 'soutenance';

    protected $fillable = [
        'module_id', 'titre', 'type', 'description',
        'date_debut', 'date_fin', 'duree_minutes', 'note_max',
    ];

    protected $casts = [
        'date_debut' => 'datetime',
        'date_fin'   => 'datetime',
    ];

    public function module()    { return $this->belongsTo(Module::class); }
    public function questions() { return $this->hasMany(Question::class); }
    public function resultats() { return $this->hasMany(Resultat::class); }
}
