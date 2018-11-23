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

    public function products()
    {
        return $this->belongsToMany('App\Product', 'DETALLE_PAGO', 'ID_ORDEN', 'COD_PROD')->withPivot('CANTIDAD', 'TOTAL_ITEM')->withTimestamps();
    }

    public function payments()
    {
        return $this->hasMany('App\Payment', 'ID_ORDEN', 'IDORDEN');
    }

    public function consult()
    {
        return $this->belongsTo('App\Consult', 'CONSULTA_ID', 'ID');
    }
    
    public function foundry()
    {
        return $this->belongsTo('App\Foundry', 'VACIADO', 'ID');
    }

    public function entry()
    {
        return $this->hasOne('App\Entry', 'ID_ORDEN', 'IDORDEN');
    }
}
