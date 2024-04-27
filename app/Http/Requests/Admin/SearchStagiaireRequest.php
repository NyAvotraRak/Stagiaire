<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SearchStagiaireRequest extends FormRequest
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
        return [
            'nom_stagiaire' => ['string', 'nullable'],
            'prenom_stagiaire' => ['string', 'nullable'],
            'date_debut' => ['date', 'nullable'],
            'date_fin' => ['date', 'nullable']
        ];
    }
}