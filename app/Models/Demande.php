<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_demande',
        'prenom_demande',
        'email_demande',
        'image_demande',
        'cv',
        'lm',
        'autres',
        'service_id',
        'etat_id',
        'niveau_id'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function etat()
    {
        return $this->belongsTo(Etat::class);
    }

    public function niveau()
    {
        return $this->belongsTo(Niveau::class);
    }

    public function detail_stage()
    {
        return $this->hasMany(Detail_stage::class);
    }
}
