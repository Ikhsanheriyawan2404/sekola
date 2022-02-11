<?php

namespace Database\Seeders;

use App\Models\Major;
use Illuminate\Database\Seeder;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Major::create([
            'name' => 'Teknik Komputer Jaringan'
        ]);

        Major::create([
            'name' => 'Rekayasa Perangkat Lunak'
        ]);

        Major::create([
            'name' => 'Teknik Kendaraan Ringan'
        ]);

        Major::create([
            'name' => 'Teknik Sepeda Motor'
        ]);
    }
}
