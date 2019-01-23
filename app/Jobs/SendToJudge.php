<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendToJudge implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    private $id;
    
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $host = "0.0.0.0"; 
        $port = 13500;
        $data = $this->id;

        if(!($sock = socket_create(AF_INET, SOCK_DGRAM, 0))) {
            $error_code = $socket_last_error();
            $error_msg = socket_strerror($error_code);
            echo "Couldn't create socket: [$error_code] $error_msg";
            return;
        }

        echo "Socket created\n";

        if (!socket_sendto($sock, "$data", strlen("$data"), 0, $host, $port)) {
            $error_code = $socket_last_error();
            $error_msg = socket_strerror($error_code);
            echo "Couldn't send `$data` to socket: [$error_code] $error_msg";
            return;
        }

        echo "`$data` is sent to server successfully!\n";
    }
}
