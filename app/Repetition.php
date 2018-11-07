<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repetition extends Model
{
    protected $table = "REPETICION";
    protected $primaryKey = "ID";
    public $incrementing = true;
    protected $fillable = [
        'TOTAL'
    ];

    public function order()
    {
        return $this->belongsTo('App\Order', 'ID_ORDEN', 'IDORDEN');
    }

    public function foundry()
    {
        return $this->belongsTo('App\Foundry', 'ID_VACIADO', 'ID');
    }
}
