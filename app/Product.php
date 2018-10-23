<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'PRODUCTS';
    protected  $primaryKey = "PRODUCT_CODE";
    public $incrementing = false;
    protected $fillable = [
        'PRODUCT_CODE',
        'PRODUCT_NAME',
        'PRODUCT_VAL'
    ];

    public function laboratories()
    {
        return $this->belongsToMany('App\Laboratory', 'LAB_HAS_PRODUCTS', 'CODE_PROD', 'LAB_ID')->withTimestamps();
    }
    
}
