<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Laboratory extends Model
{
    protected $table = 'LABORATORIES';
    protected  $primaryKey = "ID";
    public $incrementing = false;
    protected $fillable = [
        'NAME',
        'LEGAL_REPRE',
        'ADDRESS',
        'TEL',
        'CEL',
        'EMAIL'
    ];

    public function products()
    {
        return $this->belongsToMany('App\Product', 'LAB_HAS_PRODUCTS', 'LAB_ID','CODE_PROD')->withPivot('COST', 'CHANGE_DATE')->withTimestamps();
    }
}
