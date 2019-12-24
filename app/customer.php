<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    //
    protected $fillable = [
        'first_name','last_name','address1','address2','city','country','email','contact'
    ];
}
