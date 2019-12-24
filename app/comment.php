<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Collection;

class comment extends Model
{
    //
    protected $fillable = [
        'comment','ticket_id','user_id'
    ];
}
