<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Collection;

class Ticket extends Model
{
    //
    protected $fillable = [
        'title','description','customer_id','sales_id','tech_id','csupport_id','solution','status','vendor','plan','amount'
    ];
}
