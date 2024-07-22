<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Representative extends Model
{
    use HasFactory;

    protected $fillable = ['id_student','nombre','email','dni','phone'];

    public function students(){
        return $this->belongsTo(Student::class);
    } 
}
