<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Genre;

class PartyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'owner_id' => User::factory(),
            'genre_id' => Genre::factory(),
            'body' => $this->faker->realText(30),
            // now()を渡す必要あり
            'start_at' => $this->faker->dateTime('Y/m/d H:i:s'),
            'finished_at' => $this->faker->dateTimeBetween($startDate = 'now', $endDate = '+4 hour'),
        ];
    }
}
