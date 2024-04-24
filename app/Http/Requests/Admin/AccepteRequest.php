<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AccepteRequest extends FormRequest
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
            'theme' => ['required', 'min:10', 'unique:detail_stages'],
            'date_debut' => ['required', 'date', 'after_or_equal:today'],
            // 'dateFin' => ['required'],
            'dure' => ['required', 'gte:1'],
            'description_theme' => ['required', 'min:8'],
            'demande_id' => ['exists:demandes,id']
        ];
    }
}
