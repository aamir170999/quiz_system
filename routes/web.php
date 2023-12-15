<?php

use App\Http\Controllers\ExamController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;
use App\Models\Exam;
use App\Models\Seminar;
use App\Models\Question;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
   
    if (!auth()->check()) {
        return redirect()->route('login');
    }
    return redirect()->route('home');
});



Auth::routes(['register' => false]);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/', function () {
//     return view('welcome');
// });


Route::resource('exams', ExamController::class);
Route::resource('questions', QuestionController::class);


Route::get('exams-datatable', [ExamController::class, 'dataTable'])->name('exams.datatable');
route::get('add-question/{exam}', [QuestionController::class, 'addQuestion'])->name('question.add');


Route::get('/student', function () {
    $exams = Exam::all();
    return view('student.index', compact('exams'));
})->name('StudentIndex');
