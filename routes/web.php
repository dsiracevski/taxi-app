<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;


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

Route::get('/', function () {
    return view('index');
});


Route::get('login/', [AuthController::class, 'create'])->name('login');
Route::post('login/', [AuthController::class, 'store']);
Route::post('logout/', [AuthController::class, 'destroy']);
Route::get('register/', function () {

    abort_if(!auth()->user()->is_admin, 403, 'No touchy, touchy... :)');

    return view('register.create');
});
Route::post('register/', [RegisterController::class, 'create']);
