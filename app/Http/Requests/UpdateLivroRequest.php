<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLivroRequest extends FormRequest
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
        $id = $this->route('id');

        return [
            'titulo' => 'sometimes|required|string|max:255',
            'sinopse' => 'sometimes|required|string',
            'autor_id' => 'sometimes|required|exists:autors,id',
            'genero_id' => 'nullable|exists:generos,id',
        ];
    }
}
