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

    public function consults()
    {
        return $this->hasMany('App\Consult', 'HCLINICA', 'NUM_PACIENTE');
    }

    public function foundries()
    {
        return $this->hasMany('App\Foundry', 'HCLINICA', 'NUM_PACIENTE');
    }

    public function box()
    {
        return $this->hasOne('App\Box', 'PACIENTE_ID', 'NUM_PACIENTE');
    }
}
