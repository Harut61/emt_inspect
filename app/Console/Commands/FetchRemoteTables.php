<?php

namespace App\Console\Commands;

use App\NsiMsKbArticle;
use App\NsiMsKbArticleRemote;
use App\NsiQueue;
use App\NsiQueueRemote;
use App\NsiResult;
use App\NsiResultRemote;
use App\OsSoft;
use App\OsSoftRemote;
use App\VPMPatchToOsSoft;
use App\VPMPatchToOsSoftRemote;
use App\Vuln;
use App\VulnRemote;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class FetchRemoteTables extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db_fetch:day';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch remote db tables to local nightly.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->updateTables([
            ['table' => 'os_soft', 'primaryKey' => 'os_soft_id', 'model' => new OsSoft(), 'remoteModel' => new OsSoftRemote()],
            ['table' => 'nsi_queue', 'primaryKey' => 'id', 'model' => new NsiQueue(), 'remoteModel' => new NsiQueueRemote()],
            ['table' => 'nsi_result', 'primaryKey' => 'id', 'model' => new NsiResult(), 'remoteModel' => new NsiResultRemote()],
            ['table' => 'vuln', 'primaryKey' => 'vuln_id', 'model' => new Vuln(), 'remoteModel' => new VulnRemote()],
            ['table' => 'nsi_ms_kb_articles', 'primaryKey' => 'id', 'model' => new NsiMsKbArticle(), 'remoteModel' => new NsiMsKbArticleRemote()]
        ]);
    }

    protected function updateTables(array $tablesInfo)
    {
        //Iterate through all models(also remote) and uodate local tables.
        foreach ($tablesInfo as $tableInfo) {
            $lastRecordId = $tableInfo['model']->max($tableInfo['primaryKey']);
            $lastRecordId = is_null($lastRecordId) ? 0 : $lastRecordId;

            switch ($tableInfo['table']) {
                case 'nsi_queue':
                    $records = $tableInfo['remoteModel']->where($tableInfo['primaryKey'], '>', $lastRecordId)->where('status_date', '>=', DB::raw('now() - INTERVAL 7 WEEK'));
                    break;
                case 'nsi_result':
                    $records = $tableInfo['remoteModel']->where($tableInfo['primaryKey'], '>', $lastRecordId)->whereRaw('queue_id in (select id from nsi_queue where status_date >= now() - INTERVAL 7 WEEK)');
                    break;
                default :
                    /** @var Collection $newRecords */
                    $records = $tableInfo['remoteModel']->where($tableInfo['primaryKey'], '>', $lastRecordId);
                    break;
            }

            if ($records->count() === 0) {
                echo "Nothing to update for {$tableInfo['model']->getTable()} table." . PHP_EOL;
            } else {
                //Insert new records to local database.
                echo "Updating {$tableInfo['model']->getTable()} table..." . PHP_EOL;
                
                $records->chunk(20000, function ($newRecords) use ($tableInfo) {
                    foreach ($newRecords->chunk(3000) as $chunk) {
                        $tableInfo['model']->query()->insert($chunk->toArray());
                    }
                });
                
                echo "Updated {$tableInfo['model']->getTable()} table." . PHP_EOL;
            }
        }
    }
}
