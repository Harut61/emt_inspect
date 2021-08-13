<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FlatReportingQuickLink extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'flat_reporting_quick_links';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'services_health',
        'vin',
        'vout',
        'net_non_microsoft',
        'net_microsoft',
    ];
}
