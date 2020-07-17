<?php


namespace App\Jobs\Documents\ChangeBalance;


use App\Jobs\IJob;
use Illuminate\Support\Facades\DB;
use App\ChangeBalance;
use Illuminate\Contracts\Auth\Authenticatable;

class CreateChangeBalance implements IJob
{
    private $data;
    private $user;

    public function __construct(Authenticatable $user, $data)
    {
        $this->user = $user;
        $this->data = $data;
    }

    public function handle()
    {
        DB::beginTransaction();

        $cb= new ChangeBalance($this->data);
        $cb->setUser($this->user);
        $cb->save();



        event(new \App\Events\ChangeBalanceCreate($cb));

        DB::commit();

        return $cb;
    }
}