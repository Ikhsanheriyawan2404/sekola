<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'school_name' => 'SMK N 1 SUZURAN',
            'image' => 'image.jpg',
            'address' => 'Desa Kempek Blok Penangisan Kecamatan Gempol Kabupaten Cirebon Jawa Barat 45161',
            'phone' => '082117088123',
            'email' => 'ikhsanheriyawan2404@gmail.com',
            'type' => 'Swasta',
        ]);
    }
}
