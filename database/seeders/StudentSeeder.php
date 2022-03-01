<?php

namespace Database\Seeders;

use App\Models\{User, Student};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $student = Student::create([
            'name' => 'Ikhsan Heriyawan',
            'nisn' => '240416',
            'gender' => 'L',
            'religion' => 'Islam',
            'classroom_id' => 1,
            'date_of_birth' => '2001-02-19',
            'phone' => '082117088123',
            'email' => 'ikhsan@gmail.com',
        ]);

        $student2 = Student::create([
            'name' => 'Kuncoro Jaya',
            'nisn' => '190201',
            'gender' => 'L',
            'religion' => 'Islam',
            'classroom_id' => 2,
            'date_of_birth' => '2001-02-19',
            'phone' => '082117088123',
            'email' => 'kuncoro@gmail.com',
        ]);

        $user = User::create([
            'name' => $student['name'],
            'email' => $student['email'],
            'password' => Hash::make($student['nisn']),
            'student_id' => $student['id'],
        ]);

        $user2 = User::create([
            'name' => $student2['name'],
            'email' => $student2['email'],
            'password' => Hash::make($student2['nisn']),
            'student_id' => $student2['id'],
        ]);

        $user->assignRole('Siswa');
        $user2->assignRole('Siswa');
    }
}
