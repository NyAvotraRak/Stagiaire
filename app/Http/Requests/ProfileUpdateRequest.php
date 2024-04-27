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
        // dd('tr');
        // return [
        //     'image_users' => ['required', 'string', 'max:255'],
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
        //     'fonction_id' => ['required', 'exists:fonctions,id'],
        //     'service_id' => ['required', 'exists:services,id']
        // ];
        return [
            'image_users' => ['required', 'image', 'max:2000'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'fonction_id' => ['required', 'exists:fonctions,id'],
            'service_id' => ['required', 'exists:services,id']
        ];
    }
}
