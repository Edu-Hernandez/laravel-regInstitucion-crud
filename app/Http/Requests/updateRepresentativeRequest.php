<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class updateRepresentativeRequest extends FormRequest
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
            'id_student'=> 'required|exists:students,id',
            'nombre'=> 'required|string|max:255',
            'email'=> 'required|string|email',
            'dni'=> 'required|string|max:8',
            'phone'=> 'required|string|max:9'

        ];
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json(
            [
                'success' => false,
                'message' => 'error en la validacion',
                'data' => $validator->errors()
            ]
            ));
    }
}
