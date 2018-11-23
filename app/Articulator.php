<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Articulator extends Model
{
    protected $table = "ARTICULADOR";
    protected $primaryKey = "ID";
    public $incrementing = false;
    protected $fillable = [
        'ID',
        'OBSERVACIONES'
    ];

    public function entry()
    {
        return $this->belongsTo('App\Entry', 'INGRESO_ID', 'ID');
    }
}
