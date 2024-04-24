<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ministere extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'description_ministere',
        'image_ministere'
    ];
}
