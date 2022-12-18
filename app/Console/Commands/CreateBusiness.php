<?php

namespace App\Console\Commands;

use App\Models\Business;
use Illuminate\Console\Command;

class CreateBusiness extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'business:create {number=1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new business models';


    public function handle(): void
    {
        Business::factory($this->argument('number'))->create();
        $this->info('Created '. $this->argument('number'). ' business models');
    }
}
