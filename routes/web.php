<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommonController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ==================
// Routes (Login/Register Pages)
// ==================

Route::get('/', function () {
  return view('welcome');
})->name('welcome');

Route::get('/login', function () {
  return view('login');
})->name('login');

Route::post('/login', [CommonController::class, 'login'])->name('login');

Route::get('/logout', [CommonController::class, 'logout'])->name('logout');

Route::get('/register', function () {
  return view('student.register');
})->name('register');

// ==================
// Student Routes
// ==================
Route::prefix('student')->name('student.')->group(function () {

  // Guest routes (login/register actions)
  Route::middleware('guest:student')->group(function () {
    Route::post('/register', [StudentController::class, 'register'])->name('register');
  });

  // Authenticated student routes
  Route::middleware('auth:student')->group(function () {
    Route::get('/home', [StudentController::class, 'home'])->name('home');
    Route::get('/profile/{id}', [StudentController::class, 'profile'])->name('profile');
    Route::get('/join-project', [StudentController::class, 'joinProject'])->name('join-project');
    Route::post('/logout', [StudentController::class, 'logout'])->name('logout');

    // Project routes for students
    Route::get('/create-project', [ProjectsController::class, 'createProject'])->name('create-project');

    Route::post('/store-project', [ProjectsController::class, 'storeProject'])->name('store-project');

    Route::get('/project/{id}', [ProjectsController::class, 'projectPage'])->name('project');

    Route::get('/logout', [CommonController::class, 'logout'])->name('logout');

    Route::post('/project-search', [ProjectsController::class, 'search'])->name('project-search');
  });
});

// ==================
// Doctor Routes
// ==================
Route::prefix('doctor')->name('doctor.')->group(function () {

  // Authenticated doctor routes
  Route::middleware('auth:doctor')->group(function () {
    Route::get('/home', [DoctorController::class, 'home'])->name('home');
    Route::get('/dashboard', [DoctorController::class, 'dashboard'])->name('dashboard');
    Route::get('/project/{id}', [ProjectsController::class, 'projectPage'])->name('project');
  });
});

// ==================
// Course Routes (if needed)
// ==================
Route::prefix('courses')->name('courses.')->middleware('auth:student,doctor')->group(function () {
  // Add course routes here if needed
});
