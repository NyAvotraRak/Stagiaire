<?php

namespace App\Http\Requests\Admin;

use App\Models\Fonction;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FonctionRequest extends FormRequest
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
        $fonctionId = $this->route('fonction')->id; // Récupérer l'ID de la fonction depuis la route

        return [
            'nom_fonction' => ['required', 'min:2', Rule::unique(Fonction::class)->ignore($fonctionId)],
            'role' => [
                'required',
                'min:2',
                Rule::unique(Fonction::class)->ignore($fonctionId)->where(function ($query) {
                    return $query->where('role', 'Administrateur');
                })
            ]
        ];
    }
}
