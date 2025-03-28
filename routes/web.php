<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return view('home');
});

Route::resource('students', StudentController::class);
Route::get('/students/search', [StudentController::class, 'search'])->name('students.search');
Route::get('/students/filter', [StudentController::class, 'filter'])->name('students.filter');

