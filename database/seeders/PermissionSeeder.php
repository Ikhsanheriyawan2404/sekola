<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'user-show',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'student-list',
            'student-create',
            'student-edit',
            'student-delete',
            'teacher-list',
            'teacher-create',
            'teacher-edit',
            'teacher-delete',
            'classroom-show',
            'classroom-list',
            'classroom-create',
            'classroom-edit',
            'classroom-delete',
            'study-list',
            'study-create',
            'study-edit',
            'study-delete',
            'major-list',
            'major-create',
            'major-edit',
            'major-delete',
            'room-list',
            'room-create',
            'room-edit',
            'room-delete',
            'finance-list',
            'finance-create',
            'finance-edit',
            'finance-delete',
            'schedule-list',
            'schedule-create',
            'schedule-edit',
            'schedule-delete',
            'setting-list',
            'setting-edit',
            'dashboard-admin',
            'dashboard-teacher',
            'dashboard-student',
            'module-list',
            'module-create',
            'module-edit',
            'module-delete',
            'quiz-list',
            'quiz-create',
            'quiz-edit',
            'quiz-delete',
            'question-create',
            'question-edit',
            'question-delete',
            'exam-list',
            'exam-create',
            'student-trash',
            'student-print',
            'teacher-trash',
            'teacher-print',
            'classroom-trash',
            'classroom-print',
            'study-trash',
            'study-print',
            'schedule-trash',
            'schedule-print',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
