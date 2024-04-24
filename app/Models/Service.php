<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_service',
        'description_service',
        'image_service'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function demandes()
    {
        return $this->hasMany(User::class);
    }

    public function getSlug()
    {
        return Str::slug($this->nom_service);
    }
}
