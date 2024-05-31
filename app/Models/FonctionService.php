<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FonctionService extends Model
{
    use HasFactory;
    // Spécifiez explicitement le nom de la table
    protected $table = 'fonction_service';

    protected $fillable = [
        'fonction_id',
        'service_id'
    ];

    // Définir les relations avec les modèles Fonction et Service

    public function fonction()
    {
        return $this->belongsTo(Fonction::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
