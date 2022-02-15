<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\StudyController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\Auth\LoginController;

// Auth::routes(['register' => false]);
Route::get('home', [HomeController::class,  'index']);
Route::get('', [LoginController::class, 'showLoginForm']);
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', [HomeController::class, 'admin'])->name('admin.dashboard');
    Route::get('/teacher/dashboard/{teacher:id}', [HomeController::class, 'teacher'])->name('teacher.dashboard');
    Route::get('/student/dashboard/{student:id}', [HomeController::class, 'student'])->name('student.dashboard');
    Route::resources(['users' => UserController::class]);
    Route::put('users/{user:id}/edit_password', [UserController::class, 'editPassword'])->name('edit.password');
    Route::resources(['roles' => RoleController::class]);
    Route::resources(['students' => StudentController::class]);
    Route::resources(['teachers' => TeacherController::class]);
    Route::resources(['majors' => MajorController::class]);
    Route::resources(['rooms' => RoomController::class]);
    Route::resources(['classrooms' => ClassroomController::class]);
    Route::get('classrooms/show/students/{id}', [ClassroomController::class, 'showStudents'])->name('classrooms.show.students');
    Route::resources(['studies' => StudyController::class]);
    Route::resources(['schedules' => ScheduleController::class]);
    Route::resources(['modules' => ModuleController::class]);
    Route::get('modules/create/{study:id}/{id}', [ModuleController::class, 'create'])->name('modules.create');

    Route::get('setting_school', [SettingController::class, 'index'])->name('settings.index');
    Route::put('setting_school/{setting:id}', [SettingController::class, 'update'])->name('settings.update');

});
