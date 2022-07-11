<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\SessionController;
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

// Session
// Login
Route::get('/login', [SessionController::class, 'login'])
    ->name('login')
    ->middleware('guest');
// Logout
Route::get('/logout', [SessionController::class, 'logout'])
    ->middleware('auth');

// Home Page
Route::get('/', function () {
    return view('home');
})->name('home')
    ->middleware('auth');

// Form Stuff
// Form Selection
Route::get('/form', [FormController::class, 'formSelection'])
    ->name('form')
    ->middleware('hasPermission:2');
// Form Page
Route::get('/form/{id}', [FormController::class, 'form'])
    ->middleware(['auth']);

Route::get('/admin/erro', function () {
        return view('admin/erro');
    })->name('erro')
        ->middleware('auth');

// Admin
// Create Users
Route::get('/admin/users/create', [AdminController::class, 'userCreate'])
    ->middleware('hasPermission:3');
// Edit Users
Route::get('/admin/users/{id}/update', [AdminController::class, 'userEdit'])
    ->middleware('hasPermission:3');
// Manage Users
Route::get('/admin/users', [AdminController::class, 'userInfo'])
    ->name('admin.users')
    ->middleware('hasPermission:3');
// View Users Info
Route::get('/admin/users/{id}', [AdminController::class, 'userDetail'])
    ->name('admin.users.info')
    ->middleware('hasPermission:3');
// Admin Stats
Route::get('/admin/stats', [AdminController::class, 'stats'])
    ->name('admin.stats')
    ->middleware('hasPermission:3');

    // Admin Forms
Route::get('/admin/forms', [AdminController::class, 'formCriar'])
->middleware('hasPermission:3');



Route::get('/prof/forms', [AdminController::class, 'formCriarProf'])
->middleware('hasPermission:1');
// Professor
// Student Info
Route::get('/prof/stats', [AdminController::class, 'statsprof'])
    ->name('prof.stats')
    ->middleware('hasPermission:1');

Route::get('/prof/users/{id}', [AdminController::class, 'userDetail'])
    ->name('prof.users.info')
    ->middleware('hasPermission:1');

// Create a new project with a student (id) and the current prof
Route::get('/prof/users/{id}/project/create', [AdminController::class, 'projectCreate'])
    ->middleware('hasPermission:1');
// Add a student to a existing project
Route::get('/prof/users/{id}/project/add', [AdminController::class, 'projectAdd'])
    ->middleware('hasPermission:1');

Route::get('/prof/proj', function () {
    return view('homeproj');
})->name('profproj')
    ->middleware('auth');

Route::get('/prof/aluno/{id}', function () {
    return view('homealuno');
})->name('prof.aluno')
    ->middleware('auth');

Route::get('/downloadpdf/{id}', [FormController::class, 'generatePDF'])
    ->middleware('auth');

Route::get('/form/{id}/enable', [FormController::class, 'formActivate'])
    ->middleware('auth');

//ADD PERGUNTAS FORM
Route::get('/form/addPerguntas/{id}', [FormController::class, 'addPerguntas'])
    ->middleware('auth');
