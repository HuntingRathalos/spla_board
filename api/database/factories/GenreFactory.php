<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GenreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => 'オープンマッチ',
            'member_num' => 4
        ];
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function privateMatch()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'プライベートマッチ',
                'member_num' => 16
            ];
        });
    }
}
