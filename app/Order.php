<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected  $table = "ORDEN_PAGO";
    protected  $primaryKey = "IDORDEN";
    public  $incrementing = true;
    protected $fillable = [
        'METODO_PAGO',
        'TOTAL_ORDEN'
    ];

    public function student()
    {
        return $this->belongsTo('App\Student', 'EST_COD', 'EST_COD');
    }

    public function patient()
    {
        return $this->belongsTo('App\Patient', 'HCLINICA', 'NUM_PACIENTE');
    }

    public function products()
    {
        return $this->belongsToMany('App\Product', 'DETALLE_PAGO', 'ID_ORDEN', 'COD_PROD')->withPivot('CANTIDAD', 'TOTAL_ITEM')->withTimestamps();
    }

    public function payments()
    {
        return $this->hasMany('App\Payment', 'ID_ORDEN', 'IDORDEN');
    }

    public function repetitions()
    {
        return $this->hasMany('App\Repetition', 'ID_ORDEN', 'IDORDEN');
    }
}
