<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teacher1 = Teacher::create([
            'name' => 'Sukirno',
            'nip' => '1902921021',
            'email' => 'guru@email.com',
            'phone' => '082119883288',
            'gender' => 'L',
        ]);

        $teacher1->studies()->sync(1);

        $teacher2 = Teacher::create([
            'name' => 'Suherti',
            'nip' => '1902921022',
            'email' => 'teacher@email.com',
            'phone' => '082423428',
            'gender' => 'P',
        ]);

        $teacher2->studies()->sync(2);
    }
}
