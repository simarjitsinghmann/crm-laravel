<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    //
    protected $fillable = [
        'first_name','last_name','email','contact','generatedby','assignedto','title', 'body','solution','customer_review'
    ];
}
