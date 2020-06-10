<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected  $fillable = [
        'name', 'email', 'position_held', 'salary', 'work_type', 'status', 'status_time', 'address', 'city', 'country', 'postal_code'
    ];
}
