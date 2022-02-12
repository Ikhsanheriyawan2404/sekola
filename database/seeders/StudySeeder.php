<?php

namespace Database\Seeders;

use App\Models\Study;
use Illuminate\Database\Seeder;

class StudySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Study::create([
            'name' => 'Pemrograman Web Dasar',
            'study_code' => 'MK201',
            'major_id' => 1,
            'type' => 'Kejuruan',
        ]);

        Study::create([
            'name' => 'Bahasa Indonesia',
            'study_code' => 'BI200',
            'major_id' => 1,
            'type' => 'Umum',
        ]);

        Study::create([
            'name' => 'Pemeliharaan Mesin',
            'study_code' => 'MK201',
            'major_id' => 1,
            'type' => 'Kejuruan',
        ]);
    }
}
