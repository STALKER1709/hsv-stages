<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resultat extends Model
{
    use HasFactory;

    protected $fillable = ['stagiaire_id', 'evaluation_id', 'score', 'commentaire', 'soumis_le'];

    protected $casts = ['soumis_le' => 'datetime'];

    public function stagiaire()   { return $this->belongsTo(Stagiaire::class); }
    public function evaluation()  { return $this->belongsTo(Evaluation::class); }

    public function mention(): string
    {
        return match(true) {
            $this->score >= 16 => 'Très bien',
            $this->score >= 14 => 'Bien',
            $this->score >= 12 => 'Assez bien',
            $this->score >= 10 => 'Passable',
            default            => 'Insuffisant',
        };
    }
}
