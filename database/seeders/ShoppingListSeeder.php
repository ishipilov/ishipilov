<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class ShoppingListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (App::environment('local')) {
            $faker = \Faker\Factory::create();
            DB::table('shopping_lists')->insert([
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'text' => $faker->sentence($nbWords = 4, $variableNbWords = true),
                'options' => json_encode([
                    'active' => false,
                ]),
                'user_id' => 1,
            ]);
            DB::table('shopping_lists')->insert([
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'text' => $faker->sentence($nbWords = 4, $variableNbWords = true),
                'options' => json_encode([
                    'active' => true,
                ]),
                'user_id' => 1,
            ]);
            DB::table('shopping_lists')->insert([
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'text' => $faker->sentence($nbWords = 4, $variableNbWords = true),
                'options' => json_encode([
                    'active' => false,
                ]),
                'user_id' => 1,
            ]);
        }
    }
}
