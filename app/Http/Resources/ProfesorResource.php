<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfesorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    //es un array asociativo que se ejecutará cuando responda el controlador
    public function toArray($request) //el parametro $request representa toda la solicitud http entrante
    {
        //indica como es que se transformarán los datos a un json
        //revuelve un array asociativo que contiene los atributos del profesor
        return [
            'id'=>$this->id,
            'nombre'=>$this->nombre,
            'apellido'=>$this->apellido,
            'dni'=>$this->dni,
            'edad'=>$this->edad,
            'email'=>$this->email
        ];
        //laravel llama automaticamente cual el resource es convertido a json
    }
}
