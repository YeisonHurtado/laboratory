<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = "NUMERO_PAGOS";
    protected  $primaryKey = "ID";
    public $incrementing = true;
    protected $fillable = [
        'CONSIGNADO'
    ];

    public function order()
    {
        return $this->belongsTo('App\Order', 'ID_ORDEN', 'IDORDEN');
    }

    public function receipts()
    {
        return $this->hasMany('App\Receipt', 'ID_NUM_PAGOS', 'ID');
    }

    public function invoicePos()
    {
        return $this->hasOne('App\InvoicePos', 'ID_PAGO', 'ID');
    }
}
