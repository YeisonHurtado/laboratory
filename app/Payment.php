<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = "NUMERO_PAGOS";
    protected  $primaryKey = "ID";
    public $incrementing = false;
    protected $fillable = [
        'CONSIGNADO'
    ];

    public function order()
    {
        return $this->belongsTo('App\Order', 'ID_ORDEN', 'IDORDEN');
    }


}
