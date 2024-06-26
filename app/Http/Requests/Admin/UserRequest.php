<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'nom_user' => 'required|string|max:255',
            'prenom_user' => 'required|string|max:255',
            'valider_user' => 'nullable|boolean',
            'email' => 'required|string|email|max:255|unique:users',
            'fonction_id' => 'required|exists:fonctions,id',
            'password' => 'required|string|min:6',
            'image_users' => 'nullable|image|max:2000',
        ];
    }
}
