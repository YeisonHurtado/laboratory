<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consult extends Model
{
    protected $table = "CONSULTA";
    protected $primaryKey = "ID";
    public $incrementing = true;
    protected $fillable = [
        'EST_COD',
        'HCLINICA'
    ];

    public function student()
    {
        return $this->belongsTo('App\Student', 'EST_COD', 'EST_COD');
    }

    public function patient()
    {
        return $this->belongsTo('App\Patient', 'HCLINICA', 'NUM_PACIENTE');
    }

    public function order()
    {
        return $this->hasOne('App\Order', 'CONSULTA_ID', 'ID');
    }
}
