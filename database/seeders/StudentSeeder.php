<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Student::create([
            'name' => 'Ikhsan Heriyawan',
            'nisn' => '240416',
            'gender' => 'L',
            'religion' => 'Islam',
            'classroom_id' => 1,
            'date_of_birth' => '2001-02-19',
            'phone' => '082117088123',
        ]);
    }
}
