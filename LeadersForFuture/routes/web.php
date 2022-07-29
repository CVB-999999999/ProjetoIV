<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\ProfController;
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

/*
->middleware(['hasPermission:x']);

x = 1,2,3 -> User Permission Level
x = 4 -> Admin and Prof
*/

// Session
// Login
Route::get('/login', [SessionController::class, 'login'])
    ->name('login')
    ->middleware('guest');
// Logout
Route::get('/logout', [SessionController::class, 'logout'])
    ->middleware('auth');

Route::get('/download', [AdminController::class, 'download'])
    ->middleware('auth');

// Home Page
Route::get('/', function () {
    return view('home');
})->name('home')
    ->middleware('auth');

// Change User Passwd
Route::get('/users/passwdreset', function () {
    return view('sessions.password');
})->middleware('auth');

// Form Stuff
// Form Selection
// Permission -> Admin
Route::get('/form', [FormController::class, 'formSelection'])
    ->name('form')
    ->middleware('hasPermission:2');
// Form Page
Route::get('/form/{id}', [FormController::class, 'form'])
    ->name('form.id')
    ->middleware(['auth']);
// Download Form PDF
Route::get('/downloadpdf/{id}', [FormController::class, 'generatePDF'])
    ->middleware('auth');
// Enable a Form
// Permission -> Teacher/Admin
Route::get('/form/{id}/enable', [FormController::class, 'formActivate'])
    ->middleware(['hasPermission:4']);
// Add questions to a Form
// Permission -> Teacher
Route::get('/form/addPerguntas/{id}', [FormController::class, 'addPerguntas'])
    ->middleware('hasPermission:4');

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
Route::get('/admin/addform', [AdminController::class, 'formCriar'])
    ->middleware('hasPermission:3');

Route::get('/admin/forms', [FormController::class, 'formSelection'])
    ->name('form')
    ->middleware('hasPermission:3');

// Admin Projetos
Route::get('/admin/addproj', [AdminController::class, 'criarProj'])
    ->middleware('hasPermission:3');
// Admin Criar Disc
Route::get('/admin/adddisc', [AdminController::class, 'criarDisc'])
    ->middleware('hasPermission:3');
// Admin Projetos
Route::get('/admin/addtoproj', [AdminController::class, 'addToproj'])
    ->middleware('hasPermission:3');
    // Admin Disciplinas

// Table with all projects
Route::get('/admin/proj', function () {
    return view('homeproj');
})->name('adminproj')->middleware('hasPermission:3');
// Disciplines
Route::get('/admin/disc', function () {
    return view('homedisc');
})->name('admindisc')->middleware('hasPermission:3');
// Admin View user Info
Route::get('/admin/aluno/{id}', [ProfController::class, 'homeAluno'])->name('admin.aluno')->middleware('hasPermission:3');
// Admin View Project Per Student
Route::get('/admin/projUser', [AdminController::class, 'projUser'])->middleware('hasPermission:3');

Route::get('/admin/discproj/{cd_discip}', [AdminController::class, 'discProj'])->name('admin.discproj')->middleware('hasPermission:3');

Route::get('/admin/eliminarUserProj/{id}/{idproj}', [ProfController::class, 'eliminarUserProj'])
    ->name('eliminar.user.proj')->middleware('hasPermission:3');
Route::get('/prof/eliminarUserProj/{id}/{idproj}', [ProfController::class, 'eliminarUserProj'])
    ->name('eliminar.user.projF')->middleware('hasPermission:1');

// Professor
// Prof View Project Per Student
Route::get('/prof/projUser', [AdminController::class, 'projUser'])->middleware('hasPermission:1');
// Student Info
Route::get('/prof/stats', [AdminController::class, 'statsprof'])
    ->name('prof.stats')
    ->middleware('hasPermission:1');
// View all student info (Projects and Forms)
Route::get('/prof/users/{id}', [AdminController::class, 'userDetail'])
    ->name('prof.users.info')
    ->middleware('hasPermission:1');
// Create Project
Route::get('/prof/addproj', [AdminController::class, 'criarProj'])
    ->middleware('hasPermission:1');
// Create a new project with a student (id) and the current prof
Route::get('/prof/users/{id}/project/create', [AdminController::class, 'projectCreate'])
    ->middleware('hasPermission:1');
// Add a student to a existing project
Route::get('/prof/users/{id}/project/add', [AdminController::class, 'projectAdd'])
    ->middleware('hasPermission:1');
// View all projects associated with a prof
Route::get('/prof/proj', function () {
    return view('homeproj');
})->name('profproj')
    ->middleware('hasPermission:1');
// View all Student associated with a projects
Route::get('/prof/aluno/{id}', [ProfController::class, 'homeAluno'])->name('prof.aluno')
    ->middleware('hasPermission:1');
// Create Forms Prof
Route::get('/prof/forms', [FormController::class, 'formSelection'])
    ->name('form')
    ->middleware('hasPermission:1');

Route::get('/prof/addform', [AdminController::class, 'formCriarProf'])
    ->middleware('hasPermission:1');    
// ?

Route::get('/prof/addtoproj', [AdminController::class, 'addToproj'])
    ->middleware('hasPermission:1');
// ?
Route::get('/admin/erro', function () {
    return view('admin/erro');
})->name('erro')
    ->middleware('hasPermission:3');
