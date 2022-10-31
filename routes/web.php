<?php

use App\Http\Controllers\AuthController;
use App\Imports\DetaileventImport;
use App\Models\Detailevent;
use App\Models\ULP;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DetaileventController;
use App\Http\Controllers\MasterdataController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\UlpController;
use App\Models\Masterdata;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::match(['get', 'post'], '/',  [DetaileventController::class, 'chartHarian']);

//custom login
Route::prefix('/auth')->name('auth.')->group(function () {
    Route::get('/login', [PegawaiController::class, 'showLogin'])->name('login')->middleware('guest');
    Route::post('/login', [PegawaiController::class, 'authenticate']);
    Route::match(['get', 'post'], '/logout', [PegawaiController::class, 'logout']);
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/password/{pass}', function ($password) {
    return password_hash($password, PASSWORD_DEFAULT);
});


Route::prefix('/user')->name('user.')->group(function () {
    Route::get('/profile', function () {
        return view('user.profile');
    });
    Route::get('/data', [PegawaiController::class, 'showUser']);
    Route::get('/add', [PegawaiController::class, 'create']);
    Route::match(['get', 'post'], '/store', [PegawaiController::class, 'store']);
    Route::get('/delete/{id}', [PegawaiController::class, 'destroy']);
});

// Route::get('/dash',  [DetaileventController::class, 'index']);
Route::match(['get', 'post'], '/dash',  [DetaileventController::class, 'index'])->name('dashboard')->middleware('auth');
Route::prefix('/main')->group(function () {
    Route::match(['get', 'post'], '/realisasi',  [DetaileventController::class, 'chartHarian']);
    Route::match(['get', 'post'], '/rank',  [DetaileventController::class, 'showRank']);
    Route::match(['get', 'post'], '/kehandalan',  [KehandalanController::class, 'index']);
    Route::get('/rank/all',  [DetaileventController::class, 'delFilter']);
});

Route::get('/chart',  [DetaileventController::class, 'tabelHarian']);

// route untuk CRUD data ULP start
Route::get('/ulp', [UlpController::class, 'index'])->middleware('auth');
Route::post('/ulp/add', [UlpController::class, 'store']);
Route::get('/ulp/delete/{id}', [UlpController::class, 'destroy']);
Route::get('/ulp/edit/{id}', [UlpController::class, 'edit']);
Route::put('/ulp/update/{id}', [UlpController::class, 'update']);
// route untuk CRUD data ULP end
// route untuk import file excel start
Route::get('/detailEvent', [DetaileventController::class, 'showDash'])->middleware('auth');
Route::post('/detailEvent/importExcel', [DetaileventController::class, 'importExcel']);
Route::get('/detailEvent/realisasi',  [DetaileventController::class, 'chartHarian']);
Route::get('/detailEvent/releup3',  [DetaileventController::class, 'releUp3']);

Route::get('/masterdata', [MasterdataController::class, 'index'])->middleware('auth');
Route::post('/masterdata/importExcel', [MasterdataController::class, 'importExcel']);
// route untuk import file excel end
Route::prefix('/truncate')->group(function () {
    Route::post('/detailevent', [DetaileventController::class, 'truncate']);
    Route::post('/masterdata', [MasterdataController::class, 'truncate']);
});

// route login dan register default laravel
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
