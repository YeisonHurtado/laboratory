<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Foundry extends Model
{
    protected $table = "VACIADO";
    protected $primaryKey = "ID";
    public $incrementing = true;
    protected $fillable = [
        'TOTAL'
    ];

    public function students()
    {
        return $this->belongsTo('App\Student', 'EST_COD', 'EST_COD');
    }

    public function patients()
    {
        return $this->belongsTo('App\Patient', 'HCLINICA', 'NUM_PACIENTE');
    }

    public function repetitions()
    {
        return $this->hasMany('App\Repetition', 'ID_VACIADO', 'ID');
    }
}
