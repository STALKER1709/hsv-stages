<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecon extends Model
{
    use HasFactory;

    const TYPE_TEXTE   = 'texte';
    const TYPE_VIDEO   = 'video';
    const TYPE_FICHIER = 'fichier';

    protected $fillable = [
        'module_id', 'titre', 'contenu', 'type', 'url_media',
        'duree_minutes', 'ordre',
    ];

    protected $casts = ['contenu' => 'string'];

    public function module() { return $this->belongsTo(Module::class); }
}
