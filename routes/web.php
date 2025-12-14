<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\CommonController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| University Project Hub - Route Definitions
|
| This file contains all web routes for the application:
| - Public routes (login, register, welcome)
| - Student routes (home, profile, projects, join requests)
| - Doctor routes (home, dashboard, project management, grading)
|
*/

// ==================
// Public Routes
// ==================

Route::get('/', function () {
  return view('welcome');
})->name('welcome');

Route::get('/login', function () {
  return view('login');
})->name('login');

Route::post('/login', [CommonController::class, 'login'])->name('login.post');

Route::get('/logout', [CommonController::class, 'logout'])->name('logout');

Route::get('/register', function () {
  return view('student.register');
})->name('register');

// ==================
// Student Routes
// ==================
Route::prefix('student')->name('student.')->group(function () {

  // Guest routes (registration)
  Route::middleware('guest:student')->group(function () {
    Route::post('/register', [StudentController::class, 'register'])->name('register');
  });

  // Authenticated student routes
  Route::middleware('auth:student')->group(function () {

    // Main pages
    Route::get('/home', [StudentController::class, 'home'])->name('home');
    Route::get('/profile/{id}', [StudentController::class, 'profile'])->name('profile');
    Route::get('/join-project', [StudentController::class, 'joinProject'])->name('join-project');

    // Project CRUD
    Route::get('/create-project', [ProjectsController::class, 'createProject'])->name('create-project');
    Route::post('/store-project', [ProjectsController::class, 'storeProject'])->name('store-project');
    Route::get('/project/{id}', [ProjectsController::class, 'projectPage'])->name('project');

    // Project search
    Route::post('/project-search', [ProjectsController::class, 'search'])->name('project-search');

    // Join request (student requesting to join)
    Route::post('/request-join-project/{id}', [ProjectsController::class, 'requestJoinProject'])->name('request-join-project');

    // Join request management (project admin only)
    Route::post('/approve-request/{id}', [ProjectsController::class, 'approveJoinRequest'])->name('approve-request');
    Route::post('/reject-request/{id}', [ProjectsController::class, 'rejectJoinRequest'])->name('reject-request');

    // Project settings (project admin only)
    Route::post('/project/{id}/update-links', [ProjectsController::class, 'updateProjectLinks'])->name('update-project-links');
  });
});

// ==================
// Doctor Routes
// ==================
Route::prefix('doctor')->name('doctor.')->group(function () {

  // Authenticated doctor routes
  Route::middleware('auth:doctor')->group(function () {

    // Main pages
    Route::get('/home', [DoctorController::class, 'home'])->name('home');
    Route::get('/dashboard', [DoctorController::class, 'dashboard'])->name('dashboard');
    Route::get('/project/{id}', [ProjectsController::class, 'projectPage'])->name('project');

    // Project management
    Route::post('/project/{id}/comment', [ProjectsController::class, 'storeComment'])->name('project.comment');
    Route::post('/project/{id}/update-status', [ProjectsController::class, 'updateProjectStatus'])->name('project.update-status');
    Route::post('/project/{id}/grade', [ProjectsController::class, 'gradeProject'])->name('project.grade');
  });
});
