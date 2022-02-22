<?php

namespace App\Imports;

use App\Models\Teacher;
use Maatwebsite\Excel\Concerns\ToModel;

class TeacherImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Teacher([
            'name' => $row[0],
            'nip' => $row[1],
            'gender' => $row[2],
            'phone' => $row[3],
            'email' => $row[4],
        ]);
    }
}
