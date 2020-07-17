<?php


namespace App\traits;


use App\Jobs\IJob;
use Illuminate\Support\Facades\Bus;

trait Jobs
{
    public function dispatch(IJob $command)
    {
        return Bus::dispatch($command);
    }
}