<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Activity extends Model
{

    protected $table='user_activities';

    protected $fillable = [
        'user_id','field_name','old_value','modified_value','modified_by',
    ];
}
