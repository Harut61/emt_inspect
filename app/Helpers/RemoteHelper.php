<?php

namespace App\Helpers;

/**
 * You will need to install ssh on this machine for this to work
 */
class RemoteHelper
{
    public static function run( $command)
    {
        $resposne = exec('sshpass -p \'' . env('SSH_PASS') . '\' ssh ' . env('SSH_USERNAME') . '@' . env('SSH_HOST') . ' "' . $command . '"');

        return $resposne;

    }
}
