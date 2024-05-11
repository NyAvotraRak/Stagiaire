<?php

namespace App\Http\Requests\Admin;

use App\Models\Demande;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class DemandeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // dd('sdf');
        // return [
        //     'nom_demande' => 'required|string|max:255',
        //     'prenom_demande' => 'required|string|max:255',
        //     'email_demande' => 'required|string|email|max:255|unique:demandes',
        //     'image_demande' => 'required|image',
        //     'cv' => 'required|mimes:pdf', // Accepter uniquement les fichiers PDF
        //     'lm' => 'required|mimes:pdf', // Accepter uniquement les fichiers PDF
        //     'autres' => 'required|mimes:pdf', // Accepter uniquement les fichiers PDF
        //     'service_id' => 'required|exists:services,id',
        //     'etat_id' => 'required|exists:etats,id',
        //     'niveau_id' => 'required|exists:niveaux,id'
        // ];
        return [
            'nom_demande' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    $count = DB::table('demandes')
                        ->where('nom_demande', $value) // Utilisez la valeur fournie par la règle
                        ->where('prenom_demande', $this->prenom_demande)
                        ->where('niveau_id', $this->niveau_id) // Utilisez la valeur fournie par la règle
                        ->where(function ($query) {
                            $query->where('etat_id', 1)
                                ->orWhere('etat_id', 2)
                                ->orWhere('etat_id', 3)
                                ->orWhere('etat_id', 6);
                        })
                        ->count();

                    if ($count > 0) {
                        $fail("Une demande avec les mêmes détails existe déjà.");
                    }
                },
            ],
            'prenom_demande' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    $count = DB::table('demandes')
                        ->where('nom_demande', $this->nom_demande) // Utilisez la valeur fournie par la règle
                        ->where('prenom_demande', $value)
                        ->where('niveau_id', $this->niveau_id) // Utilisez la valeur fournie par la règle
                        ->where(function ($query) {
                            $query->where('etat_id', 1)
                                ->orWhere('etat_id', 2)
                                ->orWhere('etat_id', 3)
                                ->orWhere('etat_id', 6);
                        })
                        ->count();

                    if ($count > 0) {
                        $fail("Une demande avec les mêmes détails existe déjà.");
                    }
                },
            ],
            'email_demande' => 'required|string|email|max:255|unique:demandes,email_demande',
            'image_demande' => 'required|image',
            'cv' => 'required|mimes:pdf', // Accepter uniquement les fichiers PDF
            'lm' => 'required|mimes:pdf', // Accepter uniquement les fichiers PDF
            'autres' => 'required|mimes:pdf', // Accepter uniquement les fichiers PDF
            'service_id' => 'required|exists:services,id',
            'etat_id' => 'required|exists:etats,id',
            'niveau_id' => [
                'required',
                'exists:niveaux,id',
                function ($attribute, $value, $fail) {
                    $count = DB::table('demandes')
                        ->where('nom_demande', $this->nom_demande)
                        ->where('prenom_demande', $this->prenom_demande)
                        ->where('niveau_id', $value)
                        ->where(function ($query) {
                            $query->where('etat_id', 1)
                                ->orWhere('etat_id', 2)
                                ->orWhere('etat_id', 3)
                                ->orWhere('etat_id', 6);
                        })
                        ->count();

                    if ($count > 0) {
                        $fail("Une demande avec les mêmes détails existe déjà.");
                    }
                },
            ],
        ];
    }
}
