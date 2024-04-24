<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_stage extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_debut',
        'date_fin',
        'theme',
        'description_theme',
        'demande_id'
    ];

    public function demande()
    {
        return $this->belongsTo(Demande::class);
    }
}
