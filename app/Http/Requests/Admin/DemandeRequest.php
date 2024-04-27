<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

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
        // dd('rf');
        return [
            'nom_demande' => 'required|string|max:255',
            'prenom_demande' => 'required|string|max:255',
            'email_demande' => 'required|string|email|max:255|unique:demandes',
            'image_demande' => 'required|image|max:2000',
            'cv' => 'required|string|max:255',
            'lm' => 'required|string|max:255',
            'autres' => 'required|string|max:255',
            'service_id' => 'required|exists:services,id',
            'etat_id' => 'required|exists:etats,id',
            'niveau_id' => 'required|exists:niveaux,id'
        ];
    }
}
