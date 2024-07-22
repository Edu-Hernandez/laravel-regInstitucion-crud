<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateDirectorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nombre' => 'required|string|max:100',
            'dni' => 'required|string|max:8',
            'telefono' => 'required|string|max:9',
            'nombre_institucion' => 'required|string|max:100'

        ];
    }
}
