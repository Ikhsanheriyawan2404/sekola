<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@role.test',
            'password' => bcrypt('admin'),
        ]);

        $operator = User::create([
            'name' => 'Operator',
            'email' => 'operator@role.test',
            'password' => bcrypt('admin'),
        ]);

        $student = User::create([
            'name' => 'Ikhsan',
            'email' => 'student@role.test',
            'password' => bcrypt('admin'),
        ]);

        $superadmin->assignRole('Superadmin');
        $operator->assignRole('Operator');
        $student->assignRole('Siswa');

    }
}
