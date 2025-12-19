<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserAnswerController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use App\Mail\TestMail;


Route::get('/test-mail', function () {
    Mail::to('abduraimovbilol074@gmail.com')->send(new TestMail());
    return 'Email yuborildi!';
});

 Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware('auth')->group(function () {
    Route::resource('teachers', TeacherController::class);
    Route::resource('students', StudentController::class);
    Route::resource('lessons', LessonController::class);
    Route::resource('questions', QuestionController::class);
    Route::resource('users', UserController::class);

    Route::get('/answers', [UserAnswerController::class, 'index'])->name('answers.index');
    Route::get('/set-answer', [UserAnswerController::class, 'setAnswer'])->name('set-answer');
    Route::post('/store-answers', [UserAnswerController::class, 'store'])->name('store-answers');
    Route::get('/answers/view/{lesson_id?}', [UserAnswerController::class, 'viewAnswers'])->name('answers.view');

});

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.show');
Route::post('/register', [AuthController::class, 'register'])->name('register.perform');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.perform');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');





