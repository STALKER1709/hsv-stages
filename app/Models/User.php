<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Rôles
    const ROLE_ADMIN      = 'admin';
    const ROLE_ENCADREUR  = 'encadreur';
    const ROLE_STAGIAIRE  = 'stagiaire';

    protected $fillable = [
        'name', 'email', 'password', 'role', 'telephone', 'whatsapp', 'avatar',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    public function isAdmin(): bool      { return $this->role === self::ROLE_ADMIN; }
    public function isEncadreur(): bool  { return $this->role === self::ROLE_ENCADREUR; }
    public function isStagiaire(): bool  { return $this->role === self::ROLE_STAGIAIRE; }

    public function stagiaire()  { return $this->hasOne(Stagiaire::class); }
    public function encadreur()  { return $this->hasOne(Encadreur::class); }
}
