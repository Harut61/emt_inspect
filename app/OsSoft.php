<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OsSoft extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'os_soft';

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
        return $this->hasMany(NsiResult::class, 'product_id', 'os_soft_id');
    }
}
