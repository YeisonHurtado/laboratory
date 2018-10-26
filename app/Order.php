<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected  $table = "ORDEN_PAGO";
    protected  $primaryKey = "IDORDEN";
    public  $incrementing = true;
    protected $fillable = [
        "METODO_PAGO",
        "REPETICION"
    ];

    public function student()
    {
        return $this->belongsTo("");
    }
}
