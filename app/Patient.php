<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = "PACIENTE";
    protected $primaryKey = "NUM_PACIENTE";
    public $incrementing = false;
    protected $fillable = [
        "NOMBRE"
    ];

    public function student()
    {
        
    }
}
