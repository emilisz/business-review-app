<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Business;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        User::factory(10)->create();
//        \App\Models\Business::factory(10)->create();
//        \App\Models\Rating::factory(100)->create();

        Business::factory()
            ->count(20)
            ->hasRatings(1)
            ->create();

         User::factory()->create([
             'name' => 'test',
             'email' => 'test@test.com',
         ]);
    }
}
