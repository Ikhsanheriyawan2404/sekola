<?php

namespace App\Imports;

use App\Models\Classroom;
use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;

class StudentImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $classroom = Classroom::where('name', $row[4])->first();

        return new Student([
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
    }
}
