<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;

class LoadData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:load {user} {dir}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle()
    {
        $email = $this->argument('user');
        $dir = $this->argument('dir');

        if (!file_exists($dir)) {
            $this->error("Directory $dir doesn't exists!");
            die;
        }

        $user = User::where('login', $email)->first();

        if (!$user) {
            $this->error("User with email $email not found!");
            die;
        }

        $this->info("User is $email");
        $this->info("dir is is $dir ");
    }
}
