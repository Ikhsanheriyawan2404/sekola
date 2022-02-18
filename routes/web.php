<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\{HomeController, RoleController, RoomController, UserController, MajorController, StudyController, ModuleController, SettingController, StudentController, TeacherController, ScheduleController, ClassroomController, QuizController};

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
    // Route::resources(['quizzes' => QuizController::class]);

    Route::prefix('quizzes')->group(function () {
        Route::get('{teacher:id}', [QuizController::class, 'index'])->name('quizzes.index');
        Route::get('create/{study:id}/{id}', [QuizController::class, 'create'])->name('quizzes.create');
        Route::get('{quiz:id}/edit', [QuizController::class, 'edit'])->name('quizzes.edit');
        Route::put('{quiz:id}', [QuizController::class, 'update'])->name('quizzes.update');
        Route::post('', [QuizController::class, 'store'])->name('quizzes.store');
        Route::delete('{quiz:id}', [QuizController::class, 'destroy'])->name('quizzes.destroy');
    });
    Route::prefix('questions')->group(function () {
        Route::get('create/{quiz:id}', [QuestionController::class, 'create'])->name('questions.create');
        Route::post('', [QuestionController::class, 'store'])->name('questions.store');
        // Route::get('{teacher:id}', [QuizController::class, 'index'])->name('quizzes.index');
    });

    Route::prefix('modules')->group(function () {
        Route::get('{student:id}', [ModuleController::class, 'index'])->name('modules.index');
        Route::post('', [ModuleController::class, 'store'])->name('modules.store');
        Route::get('create/{study:id}/{id}/{teacher:id}', [ModuleController::class, 'create'])->name('modules.create');
        Route::get('{study:id}/show', [ModuleController::class, 'show'])->name('modules.show');
        Route::put('{module:id}', [ModuleController::class, 'update'])->name('modules.update');
        Route::delete('{module:id}', [ModuleController::class, 'destroy'])->name('modules.destroy');
        Route::get('{module:id}/{id}/edit', [ModuleController::class, 'edit'])->name('modules.edit');
    });

    Route::get('setting_school', [SettingController::class, 'index'])->name('settings.index');
    Route::put('setting_school/{setting:id}', [SettingController::class, 'update'])->name('settings.update');

});
