<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    protected $table = "INGRESO";
    protected $primaryKey = "ID";
    public $incrementing = true;
    protected $fillable = [
        'PREESCRIPCION',
        'FECHA_INGRESO',
        'D11',
        'D12',
        'D13',
        'D14',
        'D15',
        'D16',
        'D17',
        'D18',
        'D21',
        'D22',
        'D23',
        'D24',
        'D25',
        'D26',
        'D27',
        'D28',
        'D31',
        'D32',
        'D33',
        'D34',
        'D35',
        'D36',
        'D38',
        'D41',
        'D42',
        'D43',
        'D44',
        'D45',
        'D46',
        'D47',
        'D48'
    ];

    public function order()
    {
        return $this->belongsTo('App\Order','ID_ORDEN', 'IDORDEN');
    }

    public function articulators()
    {
        return $this->hasMany('App\Articulator', 'INGRESO_ID', 'ID');
    }

    public function laboratory()
    {
        return $this->belongsTo('App\Laboratory', 'LABORATORY_ID', 'ID');
    }
}
