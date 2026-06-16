<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = ['pole_id', 'encadreur_id', 'titre', 'description', 'ordre', 'duree_heures'];

    public function pole()        { return $this->belongsTo(Pole::class); }
    public function encadreur()   { return $this->belongsTo(Encadreur::class); }
    public function lecons()      { return $this->hasMany(Lecon::class)->orderBy('ordre'); }
    public function evaluations() { return $this->hasMany(Evaluation::class); }
}
