<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home Student
Breadcrumbs::for('home_student', function (BreadcrumbTrail $trail, $student) {
    $trail->push('Home', route('student.dashboard', $student));
});

// Home Teacher
Breadcrumbs::for('home_teacher', function (BreadcrumbTrail $trail, $teacher) {
    $trail->push('Home', route('teacher.dashboard', $teacher));
});

// Home Admin
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('admin.dashboard'));
});

// Home > Siswa
Breadcrumbs::for('students', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Siswa', route('students.index'));
});
// Home > Siswa > [Create]
Breadcrumbs::for('create_student', function (BreadcrumbTrail $trail) {
    $trail->parent('students');
    $trail->push('Tambah Siswa', route('students.create'));
});
// Home > Siswa > [Edit]
Breadcrumbs::for('edit_student', function (BreadcrumbTrail $trail, $student) {
    $trail->parent('students');
    $trail->push("Edit : {$student->name}", route('students.edit', $student));
});

// Home > Guru
Breadcrumbs::for('teachers', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Guru', route('teachers.index'));
});
// Home > Guru > [Create]
Breadcrumbs::for('create_teacher', function (BreadcrumbTrail $trail) {
    $trail->parent('teachers');
    $trail->push('Tambah Guru', route('teachers.create'));
});
// Home > Guru > [Edit]
Breadcrumbs::for('edit_teacher', function (BreadcrumbTrail $trail, $teacher) {
    $trail->parent('teachers');
    $trail->push("Edit : {$teacher->name}", route('teachers.edit', $teacher));
});

// Home > Kelas
Breadcrumbs::for('classrooms', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Kelas', route('classrooms.index'));
});
// Home > Kelas > [Create]
Breadcrumbs::for('create_classroom', function (BreadcrumbTrail $trail) {
    $trail->parent('classrooms');
    $trail->push('Tambah Kelas', route('classrooms.create'));
});
// Home > Kelas > [Edit]
Breadcrumbs::for('edit_classroom', function (BreadcrumbTrail $trail, $classroom) {
    $trail->parent('classrooms');
    $trail->push("Edit : {$classroom->name}", route('classrooms.edit', $classroom));
});

// Home > Mata Pelajaran
Breadcrumbs::for('studies', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Mata Pelajaran', route('studies.index'));
});
// Home > Mata Pelajaran > [Create]
Breadcrumbs::for('create_study', function (BreadcrumbTrail $trail) {
    $trail->parent('studies');
    $trail->push('Tambah Mata Pelajaran', route('studies.create'));
});
// Home > Mata Pelajaran > [Edit]
Breadcrumbs::for('edit_study', function (BreadcrumbTrail $trail, $study) {
    $trail->parent('studies');
    $trail->push("Edit : {$study->name}", route('studies.edit', $study));
});

// Home > Jadwal
Breadcrumbs::for('schedules', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Jadwal', route('schedules.index'));
});
// Home > Jadwal > [Show]
Breadcrumbs::for('show_schedule', function (BreadcrumbTrail $trail) {
    $trail->parent('schedules');
    $trail->push('Lihat Jadwal', route('schedules.index'));
});
// Home > Jadwal > [Create]
Breadcrumbs::for('create_schedule', function (BreadcrumbTrail $trail) {
    $trail->parent('schedules');
    $trail->push('Tambah Jadwal', route('schedules.create'));
});
// Home > Jadwal > [Edit]
Breadcrumbs::for('edit_schedule', function (BreadcrumbTrail $trail, $schedule) {
    $trail->parent('schedules');
    $trail->push("Edit : {$schedule->name}", route('schedules.edit', $schedule));
});
// // Home > Jadwal > [Show]
// Breadcrumbs::for('show_schedule', function (BreadcrumbTrail $trail, $classroom) {
//     $trail->parent('schedules');
//     $trail->push("Show", route('schedules.show', $classroom));
// });

// Home > Modul
Breadcrumbs::for('modules', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Modul', route('modules.index'));
});
// Home > Modul > [Create]
Breadcrumbs::for('create_module', function (BreadcrumbTrail $trail) {
    $trail->parent('modules');
    $trail->push('Tambah Modul', route('modules.create'));
});
// Home > Modul > [Edit]
Breadcrumbs::for('edit_module', function (BreadcrumbTrail $trail, $module) {
    $trail->parent('modules');
    $trail->push("Edit : {$module->name}", route('modules.edit', $module));
});

// Home > Users
Breadcrumbs::for('users', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Pengguna', route('users.index'));
});

// Home > Users > [Create]
Breadcrumbs::for('create_user', function (BreadcrumbTrail $trail) {
    $trail->parent('users');
    $trail->push('Buat Pengguna', route('users.create'));
});
// Home > Users > [Edit]
Breadcrumbs::for('edit_user', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('users');
    $trail->push("Edit : {$user->name}", route('users.edit', $user));
});

// Home > Roles
Breadcrumbs::for('roles', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Role', route('roles.index'));
});
// Home > Roles > [Create]
Breadcrumbs::for('create_role', function (BreadcrumbTrail $trail) {
    $trail->parent('roles');
    $trail->push('Buat Role', route('roles.create'));
});
// Home > Roles > [Edit]
Breadcrumbs::for('edit_role', function (BreadcrumbTrail $trail, $role) {
    $trail->parent('roles');
    $trail->push("Edit : {$role->name}", route('roles.edit', $role));
});

// Home > Jurusan
Breadcrumbs::for('majors', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Jurusan', route('majors.index'));
});

// Home > Ruang
Breadcrumbs::for('rooms', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Ruang Kelas', route('rooms.index'));
});

// Home > Setting
Breadcrumbs::for('settings', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Info Sekolah', route('settings.index'));
});
