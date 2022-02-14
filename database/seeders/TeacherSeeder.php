<?php

namespace Database\Seeders;

use App\Models\{Teacher, User};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            'email' => 'sukirno@mail.test',
            'phone' => '082119883288',
            'gender' => 'L',
        ]);

        $teacher1->studies()->sync(1);
        $user = User::create([
            'name' => $teacher1['name'],
            'email' => $teacher1['email'],
            'password' => Hash::make($teacher1['nip']),
            'teacher_id' => $teacher1['id'],
        ]);

        $user->assignRole('Guru');

        $teacher2 = Teacher::create([
            'name' => 'Suherti',
            'nip' => '240416',
            'email' => 'suherti@mail.test',
            'phone' => '082423428',
            'gender' => 'P',
        ]);

        $user2 = User::create([
            'name' => $teacher2['name'],
            'email' => $teacher2['email'],
            'password' => Hash::make($teacher2['nip']),
            'teacher_id' => $teacher2['id'],
        ]);

        $user2->assignRole('Guru');

        $teacher2->studies()->sync(2);
    }
}
