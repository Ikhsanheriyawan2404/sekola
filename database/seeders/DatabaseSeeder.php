<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\SettingSeeder;
use Database\Seeders\ScheduleSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PermissionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            RoomSeeder::class,
            MajorSeeder::class,
            StudySeeder::class,
            TeacherSeeder::class,
            ClassroomSeeder::class,
            StudentSeeder::class,
            SettingSeeder::class,
            ScheduleSeeder::class,
        ]);
        \App\Models\Student::factory(50)->create();
    }
}
