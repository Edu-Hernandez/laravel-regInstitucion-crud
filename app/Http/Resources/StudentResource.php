<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //como se transformaran los datos de student cuando se convierta en json
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'age'=>$this->age
        ];
        //laravel llama automaticamente cual el resource es convertido a json
    }
}
