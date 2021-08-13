<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NsiMsKbArticleRemote extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'vuln_track.nsi_ms_kb_articles';

    /**
     * The connection name for the model.
     *
     * @var string|null
     */
    protected $connection = 'mysql2';
}
