<?php

namespace App\Http\Requests\Admin;

use App\Models\Fonction;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FonctionRequest extends FormRequest
{
    /**
     * Détermine si l'utilisateur est autorisé à effectuer cette requête.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Obtient les règles de validation qui s'appliquent à la requête.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $fonctionId = $this->route('fonction') ? $this->route('fonction')->id : null;

        $rules = [
            'nom_fonction' => [
                'required',
                'min:2',
                // Règle de validation pour s'assurer que le nom de la fonction est unique dans le contexte d'un service spécifique
                Rule::unique('fonctions')->where(function ($query) {
                    return $query->where('service_id', $this->input('service_id'));
                })->ignore($fonctionId),
            ],
            'role' => [
                'required',
                'min:2',
                // Règle de validation pour s'assurer qu'il n'y a pas plusieurs rôles "Administrateur" pour la même fonction
                Rule::unique(Fonction::class)->ignore($fonctionId)->where(function ($query) {
                    return $query->where('role', 'Administrateur');
                })
            ],
        ];

        if ($this->isMethod('post')) {
            // Règles pour la création d'une nouvelle fonction
            $rules['service_id'] = ['required', 'array'];
            $rules['service_id.*'] = ['exists:services,id'];
        } elseif ($this->isMethod('put')) {
            // Règles pour la mise à jour d'une fonction existante
            $rules['service_id'] = ['required', 'exists:services,id'];
        }

        return $rules;
    }

    /**
     * Obtient les messages personnalisés pour les erreurs de validation.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'nom_fonction.required' => 'Le champ nom de fonction est requis.',
            'nom_fonction.min' => 'Le nom de fonction doit contenir au moins 2 caractères.',
            'nom_fonction.unique' => 'Le nom de fonction existe déjà dans ce service.',
            'service_id.required' => 'Le champ service est requis.',
            'service_id.array' => 'Le champ service id doit être un tableau.',
            'service_id.exists' => 'Le service sélectionné est invalide.',
        ];
    }
}
