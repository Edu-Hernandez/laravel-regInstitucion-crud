<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RepresentativeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'id_student'=>$this->id_student,
            'nombre'=>$this->nombre,
            'email'=>$this->email,
            'dni'=>$this->dni,
            'phone'=>$this->phone
        ];
    }
}
