<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogAuthentication extends Model
{
    //
    protected $table='logs_authentication';

    protected $fillable = [
        'user_id','login_time','logout_time','ip_address','browser_agent',
    ];
}
