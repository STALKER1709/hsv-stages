<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['evaluation_id', 'enonce', 'points', 'ordre'];

    public function evaluation() { return $this->belongsTo(Evaluation::class); }
    public function reponses()   { return $this->hasMany(Reponse::class); }
}
