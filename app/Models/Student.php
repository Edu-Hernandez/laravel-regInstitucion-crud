<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    //definimos los atributos que van hacer asignados en masa
    //se asignen de una sola vez 
    protected $fillable = ["name","age"];

    public function representative(){
        return $this->hasMany(Representative::class); //se llama al modelo
    }
    //protected $table = 'students';
}
