<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Lecturer\ExamController;
use App\Http\Controllers\Student\StudentExamController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Lecturer\ExamAssignController;
use App\Http\Controllers\Lecturer\SubjectController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ClassRoomController;
use App\Http\Controllers\Admin\StudentClassController;
use App\Http\Controllers\Admin\LecturerClassController;
use App\Http\Controllers\Lecturer\LecturerExamResultController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/students', [\App\Http\Controllers\Lecturer\StudentController::class, 'index'])->name('students.index');
    Route::get('/lecturer/dashboard',[\App\Http\Controllers\Lecturer\LecturerDashboardController::class,'index'])->name('lecturer.dashboard');
});

Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::put('/users/{user}/role', [UserController::class, 'updateRole'])->name('users.update-role');
        Route::resource('class-rooms',ClassRoomController::class)->except('show');
        Route::get('/students/assign-class',[StudentClassController::class, 'index'])->name('students.assign-class');
        Route::put('/students/{user}/assign-class',[StudentClassController::class, 'update'])->name('students.assign-class.update');
        Route::get('/lecturers/assign-class', [LecturerClassController::class, 'index'])->name('lecturers.assign-class');
        Route::put('/lecturers/{user}/assign-class', [LecturerClassController::class, 'update'])->name('lecturers.assign-class.update');
         Route::get('/lecturer/exams/{exam}/assign', [ExamAssignController::class, 'edit'])
        ->name('lecturer.exams.assign');

    Route::post('/lecturer/exams/{exam}/assign', [ExamAssignController::class, 'update'])
        ->name('lecturer.exams.assign.update');
    });

Route::middleware(['auth'])
    ->name('lecturer.')
    ->group(function () {
        Route::resource('subjects', SubjectController::class);
        Route::resource('exams', \App\Http\Controllers\Lecturer\ExamController::class)->only(['index','create','store']);
        Route::get('/lecturer/exams/{exam}/results',[\App\Http\Controllers\Lecturer\ResultController::class,'index'])->name('exams.results');
        Route::get('/exams/{exam}/questions',[\App\Http\Controllers\Lecturer\QuestionController::class, 'index'])->name('questions.index');
        Route::post('/exams/{exam}/questions',[\App\Http\Controllers\Lecturer\QuestionController::class, 'store'])->name('questions.store');
        Route::patch('/exams/{exam}/toggle',[\App\Http\Controllers\Lecturer\ExamController::class,'toggle'])->name('exams.toggle');
        Route::get('/lecturer/exams/{exam}/mark',[\App\Http\Controllers\Lecturer\ExamMarkController::class,'index'])->name('exams.mark');
        Route::post('/lecturer/answers/{answer}/mark',[\App\Http\Controllers\Lecturer\ExamMarkController::class,'mark'])->name('answers.mark');
        
        Route::get('/exams/{exam}/results', [LecturerExamResultController::class, 'index'])->name('exams.results');

        Route::get('/exams/{exam}/results/{attempt}', [LecturerExamResultController::class, 'show'])->name('exams.results.show');

        Route::post('/exams/{exam}/results/{attempt}/grade', [LecturerExamResultController::class, 'grade'])->name('exams.results.grade');

    });

Route::middleware(['auth'])
    ->prefix('student')
    ->group(function () {
    Route::get('/exams', [\App\Http\Controllers\Student\ExamController::class, 'index'])->name('student.exams.index');
    Route::get('/exams/{exam}', [\App\Http\Controllers\Student\ExamController::class, 'show'])->name('student.exams.show');
    Route::post('/exams/{exam}/submit', [\App\Http\Controllers\Student\ExamController::class, 'submit'])->name('student.exams.submit');
    Route::get('/exams/{exam}/result', [\App\Http\Controllers\Lecturer\StudentExamResultController::class, 'show'])->name('student.exams.result');
    Route::post('/exams/{exam}/start', [\App\Http\Controllers\Student\ExamController::class, 'start'])->name('student.exams.start');
});




require __DIR__.'/auth.php';
