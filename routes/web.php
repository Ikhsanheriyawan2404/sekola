<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamController;
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
    Route::get('students/export', [StudentController::class, 'export'])->name('students.export');
    Route::post('students/import', [StudentController::class, 'import'])->name('students.import');
    Route::get('students/printpdf', [StudentController::class, 'printPDF'])->name('students.printpdf');
    Route::get('teachers/export', [TeacherController::class, 'export'])->name('teachers.export');
    Route::post('teachers/import', [TeacherController::class, 'import'])->name('teachers.import');
    Route::get('teachers/printpdf', [TeacherController::class, 'printPDF'])->name('teachers.printpdf');

    Route::resources(['students' => StudentController::class]);
    Route::resources(['teachers' => TeacherController::class]);
    Route::resources(['majors' => MajorController::class]);
    Route::resources(['rooms' => RoomController::class]);
    Route::resources(['classrooms' => ClassroomController::class]);
    Route::get('classrooms/show/students/{id}', [ClassroomController::class, 'showStudents'])->name('classrooms.show.students');
    Route::resources(['studies' => StudyController::class]);
    Route::resources(['schedules' => ScheduleController::class]);

    Route::prefix('quizzes')->group(function () {
        Route::get('{teacher:id}', [QuizController::class, 'index'])->name('quizzes.index');
        Route::get('create/{study:id}/{id}', [QuizController::class, 'create'])->name('quizzes.create');
        Route::get('{quiz:id}/show', [QuizController::class, 'show'])->name('quizzes.show');
        Route::get('{quiz:id}/edit', [QuizController::class, 'edit'])->name('quizzes.edit');
        Route::put('{quiz:id}', [QuizController::class, 'update'])->name('quizzes.update');
        Route::post('', [QuizController::class, 'store'])->name('quizzes.store');
        Route::delete('{quiz:id}', [QuizController::class, 'destroy'])->name('quizzes.destroy');
        Route::post('{quiz:id}/status', [QuizController::class, 'changeStatus'])->name('quizzes.status');
        Route::get('{quiz:id}/result', [QuizController::class, 'result'])->name('quizzes.result');
    });
    Route::prefix('questions')->group(function () {
        Route::get('create/{quiz:id}', [QuestionController::class, 'create'])->name('questions.create');
        Route::post('', [QuestionController::class, 'store'])->name('questions.store');
        Route::get('{quiz:id}/{question:id}/edit', [QuestionController::class, 'edit'])->name('questions.edit');
        Route::delete('{question:id}', [QuestionController::class, 'destroy'])->name('questions.destroy');
    });

    Route::prefix('exams')->group(function () {
        Route::get('{quiz:id}', [ExamController::class, 'show'])->name('exams.show');
        Route::post('', [ExamController::class, 'store'])->name('exams.store');
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

    Route::prefix('trash')->group(function () {
        Route::get('students', [StudentController::class, 'trash'])->name('students.trash');
        Route::get('students/restore/{id}', [StudentController::class, 'restore'])->name('students.restore');
        Route::delete('students/delete/{id}', [StudentController::class, 'deletePermanent'])->name('students.deletePermanent');
        Route::delete('students/deleteAll/', [StudentController::class, 'deleteAll'])->name('students.deleteAll');
        Route::get('teachers', [TeacherController::class, 'trash'])->name('teachers.trash');
        Route::get('teachers/restore/{id}', [TeacherController::class, 'restore'])->name('teachers.restore');
        Route::delete('teachers/delete/{id}', [TeacherController::class, 'deletePermanent'])->name('teachers.deletePermanent');
        Route::delete('teachers/deleteAll/', [TeacherController::class, 'deleteAll'])->name('teachers.deleteAll');
        Route::get('classrooms', [ClassroomController::class, 'trash'])->name('classrooms.trash');
        Route::get('classrooms/restore/{id}', [ClassroomController::class, 'restore'])->name('classrooms.restore');
        Route::delete('classrooms/delete/{id}', [ClassroomController::class, 'deletePermanent'])->name('classrooms.deletePermanent');
        Route::delete('classrooms/deleteAll/', [ClassroomController::class, 'deleteAll'])->name('classrooms.deleteAll');

        Route::get('studies', [StudyController::class, 'trash'])->name('studies.trash');
        Route::get('studies/restore/{id}', [StudyController::class, 'restore'])->name('studies.restore');
        Route::delete('studies/delete/{id}', [StudyController::class, 'deletePermanent'])->name('studies.deletePermanent');
        Route::delete('studies/deleteAll/', [StudyController::class, 'deleteAll'])->name('studies.deleteAll');

        Route::get('schedules', [ScheduleController::class, 'trash'])->name('schedules.trash');
        Route::get('schedules/restore/{id}', [ScheduleController::class, 'restore'])->name('schedules.restore');
        Route::delete('schedules/delete/{id}', [ScheduleController::class, 'deletePermanent'])->name('schedules.deletePermanent');
        Route::delete('schedules/deleteAll/', [ScheduleController::class, 'deleteAll'])->name('schedules.deleteAll');
    });

    Route::get('setting_school', [SettingController::class, 'index'])->name('settings.index');
    Route::put('setting_school/{setting:id}', [SettingController::class, 'update'])->name('settings.update');
});
