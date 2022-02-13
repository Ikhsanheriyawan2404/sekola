<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $genders = ['L', 'P'];
        $religions = ['Islam', 'Kristen', 'Katolik', 'Hindu',  'Buddha', 'Khonghucu'];

        return [
            'name' => $this->faker->name(),
            'nisn' => $this->faker->unique()->numberBetween(1, 999999),
            'gender' => $genders[rand(0,1)],
            'religion' => $religions[rand(0,5)],
            'classroom_id' => rand(1,2),
            'date_of_birth' => $this->faker->date(),
            'phone' => $this->faker->numberBetween(1, 999999),
            'address' => $this->faker->address(),
        ];
    }
}
