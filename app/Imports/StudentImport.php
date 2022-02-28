<?php

namespace App\Imports;

use App\Models\{User, Student, Classroom};
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;

class StudentImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $classroom = Classroom::where('name', $row[4])->first();
            $student = Student::create([
                'name' => $row[0],
                'nisn' => $row[1],
                'gender' => $row[2],
                'religion' => $row[3],
                'classroom_id' => $classroom->id,
                'date_of_birth' => $row[5],
                'phone' => $row[6],
                'email' => $row[7],
                'address' => $row[8],
            ]);

            $user = User::create([
                'student_id' => $student->id,
                'name' => $student->name,
                'email' => $student->email,
                'password' => Hash::make($student->nisn),
            ]);

            $user->assignRole('Siswa');
        }
    }
}
