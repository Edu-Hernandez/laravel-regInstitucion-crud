<?php
namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class storeStudentRequest extends FormRequest
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

    
    //metodo de reglas de validacion o solicitud
    public function rules()
    {
        return [
            'name'=> 'required|string|max:255',
            'age' => 'required|integer|min:3'
        ];
    }

    //funcion si es que falla la validación
    public function failedValidation(Validator $validator){
        throw new HttpResponseException( response()->json(
            [
                //indicador booleano
                'success' => false,
                'message' => 'error en la validacion',
                'data' => $validator->errors()
            ]
            ));
    }
}
