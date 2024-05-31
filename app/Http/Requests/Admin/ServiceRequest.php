<?php

namespace App\Http\Requests\Admin;

use App\Models\Service;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ServiceRequest extends FormRequest
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
        $serviceId = $this->route('service') ? $this->route('service')->id : null; // Vérifie si $niveau est défini
        $rules = [
            'nom_service' => [
                'required',
                'min:2',
                // Règle unique, ignorée pour le service en cours d'édition
                Rule::unique('services')->ignore($serviceId)
            ],
            'description_service' => ['required', 'min:8'],
        ];

        // Ajoutez les règles uniquement si c'est une création de service
        if ($this->isMethod('post')) {
            $rules['image_service'] = ['nullable', 'image'];
        }

        return $rules;
    }
}
