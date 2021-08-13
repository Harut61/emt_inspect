<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FlatTimeline extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'flat_timelines';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'total_vin',
        'total_vout',
        'total_net',
        'non_microsoft_vin',
        'non_microsoft_vout',
        'non_microsoft_net',
        'microsoft_vin',
        'microsoft_vout',
        'microsoft_net',
    ];


}
