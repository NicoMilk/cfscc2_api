<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Event;
use App\Models\Blogpost;
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
        User::factory(3)->create();
        // \App\Models\User::factory(10)->create();
        Event::factory(5)->create();
        Blogpost::factory(5)->create();
    }
}
