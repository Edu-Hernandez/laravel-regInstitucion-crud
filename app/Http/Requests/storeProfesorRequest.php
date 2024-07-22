<?php
namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class storeProfesorRequest extends FormRequest 
//formrequest facilita la validación y la autorización de las solicitudes HTTP
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
    public function rules() //metodo de reglas de validacion o solicitud
    {
        return [
            'nombre'=> 'required|string|max:255',
            'apellido'=> 'required|string|max:255',
            'dni'=> 'required|string|max:8',
            'edad'=> 'required|integer|max:120',
            'email'=> 'required|string|email|max:255'

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
