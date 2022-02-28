<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $genders = ['L', 'P'];

        $teacher =  [
            'name' => $this->faker->name(),
            'nip' => $this->faker->unique()->numberBetween(1, 999999),
            'gender' => $genders[rand(0,1)],
            'email' => $this->faker->email(),
            'phone' => $this->faker->numberBetween(1, 999999),
        ];

        return $teacher;
    }
}
