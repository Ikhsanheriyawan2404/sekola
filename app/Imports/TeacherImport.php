<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Teacher;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;

class TeacherImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $teacher = Teacher::create([
                'name' => $row[0],
                'nip' => $row[1],
                'gender' => $row[2],
                'email' => $row[3],
                'phone' => $row[4],
            ]);

            $user = User::create([
                'teacher_id' => $teacher->id,
                'name' => $teacher->name,
                'email' => $teacher->email,
                'password' => Hash::make($teacher->nip),
            ]);

            $user->assignRole('Guru');
        }
    }
}
