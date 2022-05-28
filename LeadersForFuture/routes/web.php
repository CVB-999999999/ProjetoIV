<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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

// TODO -> Middleware para verificar o tipo de utilizador e se tem acesso ao form

Route::group(['middleware' => ['sessionCheck']], function () {

    // Session
    Route::get('/login', [SessionController::class, 'login'])->name('login');
    Route::get('/logout', [SessionController::class, 'logout']);
    // Home
    Route::get('/', function () {

        if (Session::get('user') == null) {
            return redirect('login');
        }

        return view('home');
    });
    // Form
    Route::get('/form', [FormController::class, 'formSelection'])->name('form');
    Route::get('/form/{id}', [FormController::class, 'form']);

    // Admin
    // Create Users
    Route::get('/admin/users/create', [AdminController::class, 'userCreate']);
    // Manage Users
    Route::get('/admin/users', [AdminController::class, 'userInfo'])
        ->name('admin.users');
    // View Users Info
    Route::get('/admin/users/{id}', [AdminController::class, 'userDetail'])
        ->name('admin.users.info');;
});
