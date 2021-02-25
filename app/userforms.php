<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class userforms extends Model
{
      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'estID', 'first_name', 'last_name', 'gender', 'email', 'address', 'bodyTemp', 'bodyTemp',
    ];
}
