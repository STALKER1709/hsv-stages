<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pole extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'slug', 'description', 'couleur', 'icone'];

    public function stagiaires()  { return $this->hasMany(Stagiaire::class); }
    public function encadreurs()  { return $this->hasMany(Encadreur::class); }
    public function modules()     { return $this->hasMany(Module::class)->orderBy('ordre'); }
}
