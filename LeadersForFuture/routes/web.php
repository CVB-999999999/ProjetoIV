<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Home;
use App\Http\Livewire\Login;
use App\Http\Livewire\Menu;
use App\Http\Livewire\Form;
use App\Http\Livewire\Form1;
use App\Http\Livewire\Form2;
use App\Http\Livewire\Form3;
use App\Http\Livewire\Form4;
use App\Http\Livewire\Form5;
use App\Http\Livewire\Form6;
use App\Http\Livewire\Form7;
use App\Http\Livewire\Models;
use App\Http\Livewire\Sidebar;
use App\Http\Livewire\Logout;

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
Route::group(['middleware' => ['sessionCheck']], function () {
    // your routes here
    Route::get('/', Home::class);
    Route::get('/teste', Form::class);
    Route::get('/menu/form/{id}', Form::class)->name('formulario');
    Route::get('/menu', Menu::class);
    Route::get('/modelos', Models::class);
    Route::get('/modelos/form1', Form1::class);
    Route::get('/modelos/form2', Form2::class);
    Route::get('/modelos/form3', Form3::class);
    Route::get('/modelos/form4', Form4::class);
    Route::get('/modelos/form5', Form5::class);
    Route::get('/modelos/form6', Form6::class);
    Route::get('/modelos/form7', Form7::class);
    Route::get('/logout',Logout::class);
});


/*Route::get('/sidebar', function () {
    return view('sidebar');
});*/
//Route::post('signin', [Login::class, 'customLogin'])->name('login.custom');
//Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom'); 



