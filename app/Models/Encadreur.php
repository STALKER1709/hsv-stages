<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encadreur extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'pole_id', 'specialite', 'bio'];

    public function user()       { return $this->belongsTo(User::class); }
    public function pole()       { return $this->belongsTo(Pole::class); }
    public function modules()    { return $this->hasMany(Module::class); }
    public function presences()  { return $this->hasMany(Presence::class); }
}
