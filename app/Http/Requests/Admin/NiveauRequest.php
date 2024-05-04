<?php

namespace App\Http\Requests\Admin;

use App\Models\Niveau;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NiveauRequest extends FormRequest
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
        $niveauId = $this->route('niveau') ? $this->route('niveau')->id : null; // Vérifie si $niveau est défini
        return [
            'nom_niveau' => ['required', 'min:2', Rule::unique(Niveau::class)->ignore($niveauId)],
        ];
    }
}
