<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCursoRequest extends FormRequest
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
            'nombre' => ['required', 'string', 'max:100'],
            'descripcion' => ['required', 'string', 'max:200'],
            'url_portada' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5048'],
            'precio' => ['required', 'integer'],
            'porcentaje_prof' => ['required', 'integer'],
            'profesor_id' => ['required', 'integer'],
            'materia_id' => ['required', 'integer'],
        ];
    }
}
