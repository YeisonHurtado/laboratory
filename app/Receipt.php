<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    protected $table = "RECIBO_CAJA";
    protected $primaryKey = "ID";
    public $incrementing = false;
    protected $fillable = [
        'CONSIGNADO'
    ];

    public function invoices()
    {
        return $this->belongsTo('App\Invoice', 'ID_FACTURA', 'IDFACTURA');
    }

    public function payments()
    {
        return $this->belongsTo('App\Payment', 'ID_NUM_PAGOS', 'ID');
    }
}
