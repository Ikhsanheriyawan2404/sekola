<?php

use App\Models\Classroom;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\StudyController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\Auth\LoginController;

// Auth::routes(['register' => false]);
Route::get('', [LoginController::class, 'showLoginForm']);
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resources(['users' => UserController::class]);
    Route::resources(['roles' => RoleController::class]);
    Route::resources(['students' => StudentController::class]);
    Route::resources(['teachers' => TeacherController::class]);
    Route::resources(['majors' => MajorController::class]);
    Route::resources(['rooms' => RoomController::class]);
    Route::resources(['classrooms' => ClassroomController::class]);
    Route::get('classrooms/show/students/{id}', [ClassroomController::class, 'showStudents'])->name('classrooms.show.students');
    Route::resources(['studies' => StudyController::class]);

});
