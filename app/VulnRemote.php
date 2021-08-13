<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VulnRemote extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'vuln_track.vuln';
    
    /**
     * The table primary key
     * 
     * @var string 
     */
    protected $primaryKey = 'vuln_id';

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
}
