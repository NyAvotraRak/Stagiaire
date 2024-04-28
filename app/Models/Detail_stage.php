<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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

    public function image_url()
    {
        return Storage::url($this->image_demande);
    }

    public function cv_url()
    {
        return Storage::url($this->cv);
    }

    public function lm_url()
    {
        return Storage::url($this->lm);
    }

    public function autres_url()
    {
        return Storage::url($this->autres);
    }

    public function demande()
    {
        return $this->belongsTo(Demande::class);
    }
}
