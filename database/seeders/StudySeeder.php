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
        $study1 = Study::create([
            'name' => 'Pemrograman Web Dasar',
            'study_code' => 'MK201',
            'major_id' => 1,
            'type' => 'Kejuruan',
        ]);

        // $study1->teachers()->sync(1);

        $study2 = Study::create([
            'name' => 'Bahasa Indonesia',
            'study_code' => 'BI200',
            'major_id' => 1,
            'type' => 'Umum',
        ]);

        // $study2->teachers()->sync(2);


        Study::create([
            'name' => 'Pemeliharaan Mesin',
            'study_code' => 'MK201',
            'major_id' => 1,
            'type' => 'Kejuruan',
        ]);
    }
}
