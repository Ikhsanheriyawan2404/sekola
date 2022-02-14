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
            'major_id' => 2,
            'type' => 'Kejuruan',
        ]);

        Study::create([
            'name' => 'Data Mining',
            'study_code' => 'MK202',
            'major_id' => 2,
            'type' => 'Kejuruan',
        ]);

        Study::create([
            'name' => 'Machine Learning',
            'study_code' => 'MK203',
            'major_id' => 2,
            'type' => 'Kejuruan',
        ]);

        Study::create([
            'name' => 'Bahasa Indonesia',
            'study_code' => 'BI200',
            'major_id' => 5,
            'type' => 'Umum',
        ]);

        Study::create([
            'name' => 'Matematika',
            'study_code' => 'MK201',
            'major_id' => 5,
            'type' => 'Kejuruan',
        ]);

        Study::create([
            'name' => 'Bahasa Inggris',
            'study_code' => 'MK201',
            'major_id' => 5,
            'type' => 'Kejuruan',
        ]);

        Study::create([
            'name' => 'Pemrograman Android Dasar',
            'study_code' => 'MK201',
            'major_id' => 2,
            'type' => 'Kejuruan',
        ]);

        Study::create([
            'name' => 'Pemeliharaan Mesin',
            'study_code' => 'MK201',
            'major_id' => 3,
            'type' => 'Kejuruan',
        ]);
    }
}
