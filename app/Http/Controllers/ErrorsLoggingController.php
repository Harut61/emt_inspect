<?php

namespace App\Http\Controllers;

use App\Helpers\CollectionHelper as HelpersCollectionHelper;
use App\Traits\LogFiles;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ErrorsLoggingController extends Controller
{
    use LogFiles;

    public function index()
    {
        $logFile = Storage::has('server_logs/sync.log') ? Storage::get('server_logs/sync.log') : '';
        $logMessages = $this->parseLogFile($logFile, true)->reverse();
        $messages = HelpersCollectionHelper::paginate($logMessages, 9);

        return view('error-logging')->with('messages', $messages);
    }

    public function downloadLogsCSV()
    {
        $logFile = Storage::get('server_logs/sync.log');
        $logMessages = $this->parseLogFile($logFile, true);

        $fileName = "Logs.csv";

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['Date', 'Message'];

        $callback = function () use ($logMessages, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($logMessages as $logMessage) {
                $row['Date']  = $logMessage['date'];
                $row['Message']    = $logMessage['message'];

                fputcsv($file, array($row['Date'], $row['Message']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
