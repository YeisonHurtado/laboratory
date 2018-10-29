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
        return $this->belongsTo('App\Student', 'EST_COD', 'EST_COD');
    }

    public function orders()
    {
        return $this->hasMany('App\Order', 'HCLINICA', 'NUM_PACIENTE');
    }
}
