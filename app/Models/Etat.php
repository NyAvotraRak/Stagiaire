<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etat extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_etat'
    ];

    public function demandes()
    {
        return $this->hasMany(User::class);
    }
}
