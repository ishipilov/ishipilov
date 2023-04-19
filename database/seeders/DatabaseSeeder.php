<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        if (App::environment('local')) {
            \App\Models\User::factory(5)->create();
            \App\Models\Article::factory(5)->create();
        }
    }
}
