<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NsiQueueRemote extends Model
{
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at',
    ];

    /**
     * The connection name for the model.
     *
     * @var string|null
     */
    protected $connection = 'mysql2';
    
    /**
     * The table associated with the model.
     *
     * @return string
     */
    public function getTable() 
    {
        return env('DB_DATABASE_SECOND') . '.nsi_queue';
    }
}
