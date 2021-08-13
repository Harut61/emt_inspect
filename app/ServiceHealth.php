<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceHealth extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'start_time', 'fail_time', 'running', 'name', 'public_name'
    ];
}
