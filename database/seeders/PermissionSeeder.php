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
            'classroom-list',
            'classroom-create',
            'classroom-edit',
            'classroom-delete',
            'studies-list',
            'studies-create',
            'studies-edit',
            'studies-delete',
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
            'setting-list',
            'setting-edit',
            'dashboard-admin',
            'dashboard-teacher',
            'dashboard-student',
            'module-list',
            'module-create',
            'module-edit',
            'module-delete',
         ];

         foreach ($permissions as $permission) {
              Permission::create(['name' => $permission]);
         }
    }
}
