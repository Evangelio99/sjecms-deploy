<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userform extends Model
{
    //
    public $timestamps = false;
    
    protected $fillable = [
        'estID', 'first_name', 'last_name', 'gender', 'email', 'address', 'bodyTemp', 'bodyTemp',
    ];
}
