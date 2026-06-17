<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pole extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'slug', 'description', 'couleur', 'icone'];

    protected static function booted(): void
    {
        static::creating(function (Pole $pole) {
            if (empty($pole->slug)) {
                $pole->slug = Str::slug($pole->nom);
            }
        });
    }

    public function stagiaires()  { return $this->hasMany(Stagiaire::class); }
    public function encadreurs()  { return $this->hasMany(Encadreur::class); }
    public function modules()     { return $this->hasMany(Module::class)->orderBy('ordre'); }
}
