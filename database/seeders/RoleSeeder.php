<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadmin = Role::create([
            'name' => 'Superadmin',
            'guard_name' => 'web'
        ]);

        $operator = Role::create([
            'name' => 'Operator',
            'guard_name' => 'web'
        ]);

        $teacher = Role::create([
            'name' => 'Guru',
            'guard_name' => 'web'
        ]);

        $student = Role::create([
            'name' => 'Siswa',
            'guard_name' => 'web'
        ]);

        $superadmin->givePermissionTo([
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
            'schedule-list',
            'schedule-create',
            'schedule-edit',
            'schedule-delete',
            'finance-list',
            'finance-create',
            'finance-edit',
            'finance-delete',
            'setting-list',
            'setting-edit',
            'dashboard-admin',
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
        ]);

        $operator->givePermissionTo([
            'user-list',
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
            'dashboard-admin',
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
        ]);

        $student->givePermissionTo([
            'dashboard-student',
            'user-show',
            // 'user-edit',
            'module-list',
            'exam-list',
            'exam-create',

        ]);

        $teacher->givePermissionTo([
            'dashboard-teacher',
            'user-show',
            // 'user-edit',
            'classroom-show',
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
        ]);
    }
}
