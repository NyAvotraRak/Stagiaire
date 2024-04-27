<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Ministere extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'description_ministere',
        'image_ministere'
    ];

    public function image_url()
    {
        return Storage::url($this->image_ministere);
    }
}
