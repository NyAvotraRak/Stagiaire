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
        $rules = [
            'nom_service' => ['required', 'min:2'],
            'description_service' => ['required', 'min:8'],
        ];

        // Ajoutez les règles uniquement si c'est une création de service
        if ($this->isMethod('post')) {
            $rules['image_service'] = ['required', 'image'];
        }

        return $rules;
    }
}
