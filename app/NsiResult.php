<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NsiResult extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'nsi_result';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public $timestamps = false;

    public function queue()
    {
        return $this->belongsTo(NsiQueue::class, 'queue_id');
    }

    public function vuln()
    {
        return $this->belongsTo(Vuln::class, 'vuln_id', 'vuln_id');
    }

    public function OsSoft()
    {
        return $this->hasOne(OsSoft::class, 'os_soft_id', 'product_id');
    }
    
    public function vulnByProductid()
    {
        return $this->hasManyThrough(Vuln::class, NsiMsKbArticle::class, 'product_id', 'vuln_id', 'product_id', 'vuln_id');
    }
    
    public function vulnByKbArticle()
    {
        return $this->hasManyThrough(Vuln::class, NsiMsKbArticle::class, 'kb_article', 'vuln_id', 'missing_ms_kb', 'vuln_id');
    }
    
    public function getHostAttribute() 
    {
        return $this->queue->host;
    }
    
    public function getCriticalityAttribute()
    {
        if ($this->vuln !== null) {
            return $this->vuln->vuln_critical_boolean;
        } elseif ($this->vulnByProductid->count() > 0 && $this->vulnByKbArticle->count() > 0) {
            return $this->vulnByProductid->filter(function ($vuln) {
                return $this->vulnByKbArticle->contains($vuln) ? true : false;
            })->first()->vuln_critical_boolean;
        } else {
            return null;
        }
    }
}
