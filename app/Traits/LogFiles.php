<?php

namespace App\Traits;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection as SupportCollection;

trait LogFiles
{
    protected function parseLogFile(string $file, bool $error)
    {
        $pattern = $error ? "/^\[[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1]).*].*error.*"
                . "|^\[[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1]).*].*connection timed out.*/i" :
            "/^\[[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1]).*]/";
        $stringsArray = explode("\n", $file);

        $matchedMessages = preg_grep($pattern, $stringsArray);
        $messagesError = collect([]);

        foreach ($matchedMessages as $matchedMessage) {
            $tmp = explode(']', $matchedMessage, 2);

            $messagesError->push([
                'date' => Carbon::createFromFormat('Y-m-d H:i:s', str_replace('[', '', $tmp[0])),
                'message' => trim($tmp[1])
            ]);
        }

        return $messagesError;
    }

    protected function createCSVDownloadFile(string $fileName, SupportCollection $logMessages)
    {
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
