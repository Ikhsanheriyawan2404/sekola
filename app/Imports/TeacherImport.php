<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class TeacherImport implements ToModel
{
    // protected $id = Teacher::all();
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $guru = new Teacher([
            'name' => $row[0],
            'nip' => $row[1],
            'gender' => $row[2],
            'email' => $row[3],
            'phone' => $row[4],
        ]);

        return $guru;
        dd(Teacher::all());


        // $teachers = User::create([
        //     'name' => $guru->name,
        //     'email' => $guru->email,
        //     'password' => Hash::make($guru->nip),
        //     'teacher_id' => $guru->id,
        // ]);

        // $teachers->assignRole('Guru');

        // dd(Teach)

    }
}
