<?php

use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\SubmissionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware('auth')->namespace('App\Http\Controllers')->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    //Quiz
    Route::get('/quizzes', [QuizController::class, 'index'])->name('quiz.index');
    Route::get('/my-quizzes', [QuizController::class, 'userIndex'])->name('quiz.userIndex');
    Route::get('/quizzes/{id}', [QuizController::class, 'show'])->name('quiz.show');
    Route::get('/create-quiz', [QuizController::class, 'create'])->name('quiz.create');
    Route::resource('quizzes', 'QuizController');

    //Question
    Route::get('/quizzes/{quiz}/create-question', [QuestionController::class, 'create'])->name('question.create');
    Route::resource('questions', 'QuestionController');

    //Submission
    Route::get('/submissions', [SubmissionController::class, 'index'])->name('submission.index');
    Route::get('/quizzes/{quiz}/submissions', [SubmissionController::class, 'quizIndex'])->name('submission.quizIndex');
    Route::resource('submissions', 'SubmissionController');
    Route::get('/quizzes/{quiz}/create-submission', [SubmissionController::class, 'create'])->name('submission.create');
    Route::get('/submissions/{id}', [SubmissionController::class, 'show'])->name('submission.show');


});


Auth::routes();
