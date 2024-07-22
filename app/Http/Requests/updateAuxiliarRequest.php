<?php

namespace App\Http\Requests;

use App\Models\Enums\Enumtype;
use Illuminate\Foundation\Http\FormRequest;

class updateAuxiliarRequest extends FormRequest
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
            'email' => 'required|string|email',
            'dni' => 'required|string|max:8',
            'turno' => 'required', 'in:'.implode(',',array_column(Enumtype::cases(), 'value')), //cuando se hace uso de enum
        ];
    }
}
