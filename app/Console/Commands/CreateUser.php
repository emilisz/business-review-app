<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create {number=1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new user models';


    public function handle()
    {
        User::factory($this->argument('number'))->create();
        $this->info('Created '. $this->argument('number'). ' user models');
    }
}
