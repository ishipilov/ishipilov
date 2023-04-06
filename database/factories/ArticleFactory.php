<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $except_user_ids = User::where('email', 'like', '%@ishipilov.ru')->pluck('id')->toArray();
        $user_id = User::all()->except($except_user_ids)->random()->id;;
        return [
            'user_id' => $user_id,
            'title' => $this->faker->sentence($nbWords = 4, $variableNbWords = true),
            'text' => $this->faker->text($maxNbChars = 3000)
        ];
    }
}
