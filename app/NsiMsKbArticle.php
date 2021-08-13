<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NsiMsKbArticle extends Model
{
    public function vuln()
    {
        return $this->belongsTo(Vuln::class, 'vuln_id', 'vuln_id');
    }
}
