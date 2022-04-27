<?php

use App\Http\Controllers\FormController;
use App\Http\Controllers\SessionController;
use App\Http\Livewire\Form;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Menu;

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
    Route::get('/login', [SessionController::class, 'login']);
    Route::get('/logout', [SessionController::class, 'logout']);
    // Home
    Route::get('/', Menu::class);
    // Form
    Route::get('/form', [FormController::class, 'formSelection']);
    Route::get('/form/{id}', Form::class);
});
