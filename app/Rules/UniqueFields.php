<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Demande;


class UniqueFields implements Rule
{
    public function passes($attribute, $value)
    {
        // Vérifiez si une ligne existe déjà avec les mêmes valeurs pour les champs spécifiés
        return !Demande::where('nom_demande', $value)
            ->orWhere('prenom_demande', $value)
            ->orWhere('email_demande', $value)
            ->orWhere('niveau_id', $value)
            ->exists();
    }

    public function message()
    {
        return 'Les champs nom_demande, prenom_demande, email_demande et niveau_id doivent être uniques sur la même ligne.';
    }
}
