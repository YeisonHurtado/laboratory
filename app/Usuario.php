<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;

class Usuario extends Model
{
    protected $table = 'USERS';
    protected $primaryKey = 'IDUSER';
    public $incrementing = true;
    protected $fillable = [
        'FIRSTNAME', 
        'SECONDNAME',
        'LASTFIRSTNAME',
        'LASTSECONDNAME',
        'USERNAME',
        'PASSWORD',
        'ACTIVE',
        'DATE_REGISTER'
    ];
}
