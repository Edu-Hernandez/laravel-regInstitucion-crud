<?php

namespace App\Models;

use App\Models\Enums\Enumtype;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auxiliar extends Model
{
    use HasFactory;

    protected $table = "auxiliars";
    
    protected $fillable = ["nombre","email","dni","turno"];

    protected $casts = [
        'turno' => Enumtype::class,
    ];
}
