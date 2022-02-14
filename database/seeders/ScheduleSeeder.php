<?php

namespace Database\Seeders;

use App\Models\Schedule;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schedule::create([
            'day' => 'Senin',
            'teacher_id' => 2,
            'study_id' => 1,
            'classroom_id' => 1,
            'room_id' => 1,
            'start' => '07:00',
            'finished' => '10:00',
        ]);

        Schedule::create([
            'day' => 'Selasa',
            'teacher_id' => 2,
            'study_id' => 2,
            'classroom_id' => 1,
            'room_id' => 1,
            'start' => '07:00',
            'finished' => '10:00',
        ]);

        Schedule::create([
            'day' => 'Rabu',
            'teacher_id' => 2,
            'study_id' => 3,
            'classroom_id' => 1,
            'room_id' => 1,
            'start' => '07:00',
            'finished' => '10:00',
        ]);

        Schedule::create([
            'day' => 'Kamis',
            'teacher_id' => 2,
            'study_id' => 4,
            'classroom_id' => 1,
            'room_id' => 1,
            'start' => '07:00',
            'finished' => '10:00',
        ]);

        Schedule::create([
            'day' => 'Jum`at',
            'teacher_id' => 2,
            'study_id' => 5,
            'classroom_id' => 1,
            'room_id' => 1,
            'start' => '07:00',
            'finished' => '10:00',
        ]);

        Schedule::create([
            'day' => 'Sabtu',
            'teacher_id' => 2,
            'study_id' => 6,
            'classroom_id' => 1,
            'room_id' => 1,
            'start' => '07:00',
            'finished' => '10:00',
        ]);
    }
}
