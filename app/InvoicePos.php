<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoicePos extends Model
{
    protected $table = "FACTURA_POS";
    protected $primaryKey = "ID";
    public $incrementing = false;
    protected $fillable = [
        'TOTAL'
    ];

    public function payment()
    {
        return $this->belongsTo('App\Payment', 'ID_PAGO', 'ID');
    }
}
