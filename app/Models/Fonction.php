<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fonction extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_fonction',
        'role',
        'service_id'
    ];
    public $timestamps = true;

    public function users()
    {
        return $this->hasMany(User::class);
    }
    // public function services()
    // {
    //     return $this->belongsToMany(Service::class, 'fonction_service');
    // }
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    // public function fonctionServices()
    // {
    //     return $this->hasMany(FonctionService::class);
    // }
}
