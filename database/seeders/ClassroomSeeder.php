<?php

namespace Database\Seeders;

use App\Models\Classroom;
use Illuminate\Database\Seeder;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Classroom::create([
            'name' => 'X RPL 1',
            'major_id' => 2,
            'teacher_id' => 2,
        ]);

        Classroom::create([
            'name' => 'X TKR 1',
            'major_id' => 3,
            'teacher_id' => 1,
        ]);
    }
}
