<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_service',
        'description_service',
        'image_service'
    ];

    public function demandes()
    {
        return $this->hasMany(User::class);
    }
    public function fonction()
    {
        return $this->hasMany(Fonction::class);
    }

    public function getSlug()
    {
        return Str::slug($this->nom_service);
    }

    public function image_url()
    {
        return Storage::url($this->image_service);
    }
    // public function fonctionServices()
    // {
    //     return $this->hasMany(FonctionService::class);
    // }
}
