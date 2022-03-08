<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TravelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(),
            'origin'        => $this->faker->text(),
            'destination'   => $this->faker->text(),
            'start_date'    => $this->faker->date(),
            'end_date'      => $this->faker->date(),
            'type'          => $this->faker->text(),
            'description'   => $this->faker->text(),
            'users_id'      => 1
        ];
    }
}
