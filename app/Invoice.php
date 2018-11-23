<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = "FACTURA";
    protected $primaryKey = "IDFACTURA";
    public $incrementing = false;
    protected $fillable = [
        'IDFACTURA',
        'TOTAL',
        'CANCELADO'
    ];

    public function receipts()
    {
        return $this->hasMany('App\Receipt', 'ID_FACTURA', 'IDFACTURA');
    }
}
