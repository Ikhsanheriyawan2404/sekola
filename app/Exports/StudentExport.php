<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;

class StudentExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Student::get(['name', 'nisn', 'gender', 'religion', 'classroom_id', 'date_of_birth', 'phone', 'email', 'address']);
    }
}
