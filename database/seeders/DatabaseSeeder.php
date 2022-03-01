<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
        // \App\Models\Student::factory(1000)->create();
        \App\Models\Teacher::factory(1000)->create();
    }
}
