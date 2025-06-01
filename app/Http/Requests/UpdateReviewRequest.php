<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReviewRequest extends FormRequest
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
            'nota' => 'sometimes|required|numeric|min:0|max:5',
            'texto' => 'nullable|string',
            'usuario_id' => 'sometimes|required|exists:usuarios,id',
            'livro_id' => 'sometimes|required|exists:livros,id',
        ];
    }
}
