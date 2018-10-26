<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = "ESTUDIANTE";
    protected $primaryKey = "EST_COD";
    public $incrementing = false;
    protected $fillable = [
        "NOMBRE_EST",
        "CORREO",
        "TEL_CEL",
        "SEMESTRE"
    ];
}
