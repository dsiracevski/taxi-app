<?php


use App\Http\Controllers\CarsController;
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
})->middleware('auth');
Route::post('register/', [RegisterController::class, 'create']);


Route::get('administration/', function () {
    return view('admin.view');
})->middleware('auth');


Route::get('cars/', [CarsController::class, 'view'])->name('viewCars');
Route::get('cars/{car}', [CarsController::class, 'show'])->name('viewCar');
Route::put('cars/{car}', [CarsController::class, 'update']);
Route::delete('cars/{car}', [CarsController::class, 'destroy']);

Route::get('locations/', [CarsController::class, 'view'])->name('viewLocations');
Route::get('locations/{location}', [CarsController::class, 'show'])->name('viewLocation');
Route::put('locations/{location}', [CarsController::class, 'update']);
Route::delete('locations/{location}', [CarsController::class, 'destroy']);

Route::get('drivers/', [CarsController::class, 'view'])->name('viewDrivers');
Route::get('drivers/{driver}', [CarsController::class, 'show'])->name('viewDriver');
Route::put('drivers/{driver}', [CarsController::class, 'update']);
Route::delete('drivers/{driver}', [CarsController::class, 'destroy']);
