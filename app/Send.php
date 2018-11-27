<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Send extends Model
{
    protected $table = "ENVIO";
    protected $primaryKey = "ID";
    public $incrementing = true;
    protected $fillable = [
        'FECHA_ENVIO'
    ];

    public function entry()
    {
        return $this->belongsTo('App\Entry', 'INGRESO_ID', 'ID');
    }
}
