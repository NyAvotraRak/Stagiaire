<?php

namespace App\Http\Requests\Admin;

use App\Models\Fonction;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
        $rules = [
            'image_users' => ['required', 'image', 'max:2000'],
            'nom_user' => ['required', 'string', 'max:255'],
            'prenom_user' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'fonction_id' => ['required', 'exists:fonctions,id'],
            'password' => ['required', 'string', 'min:6'],
            'service_id' => ['required', 'exists:services,id']
        ];

        // Vérifier si le rôle "Administrateur" est déjà pris
        if ($this->request->get('fonction_id')) {
            $fonction = Fonction::find($this->request->get('fonction_id'));
            if ($fonction && $fonction->role === 'Administrateur') {
                // Supprimez la règle 'fonction_id' existante
                unset($rules['fonction_id']);

                // Ajoutez la règle 'fonction_id' avec les règles existantes et la nouvelle règle 'not_in'
                $rules['fonction_id'][] = 'not_in:' . $this->request->get('fonction_id');
            }
        }

        return $rules;
    }
}
