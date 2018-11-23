<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Box extends Model
{
    protected $table = "CAJAS";
    protected $primaryKey = "ID";
    public $incrementing = true;
    protected $fillable = [
        'DESCRIPCION'
    ];

    public function patient()
    {
        return $this->belongsTo('App\Patient', 'PACIENTE_ID', 'NUM_PACIENTE');
    }
}
