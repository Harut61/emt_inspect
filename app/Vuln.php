<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vuln extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'vuln';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public $timestamps = false;

    public function NsiResults()
    {
        return $this->hasMany(NsiResult::class, 'vuln_id', 'vuln_id');
    }
}
