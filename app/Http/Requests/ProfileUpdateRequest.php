<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        // dd('er');
        return [
            'image_users' => ['image', 'max:2000'],
            'nom_user' => ['required', 'string', 'max:255'],
            'prenom_user' => ['required', 'string', 'max:255'],
            'valider_user' => ['nullable', 'boolean'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->user()->id),
            ],
            'fonction_id' => [
                'required',
                Rule::unique('users', 'fonction_id')->ignore($this->user()->id),
            ],
            // 'password' => 'required|string|min:6',
        ];
    }
}
