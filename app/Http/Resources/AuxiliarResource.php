<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AuxiliarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    //funcion que devuelve la transformación a un json al momento que ejecuta el cc
    public function toArray($request)
    {
        return [
            'id'=> $this->id,
            'nombre'=>$this->nombre,
            'email'=>$this->email,
            'dni'=>$this->dni,
            'turno'=>$this->turno
        ];
    }
}
