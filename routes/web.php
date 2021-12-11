<?php


use App\Http\Controllers\CarsController;
use App\Http\Controllers\DriversController;
use App\Http\Controllers\LocationsController;
use App\Http\Controllers\UsersController;
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

Route::post('assign/{car}', [CarsController::class, 'assignDriver']);


Route::get('users/', [UsersController::class, 'view'])->name('viewUsers');
Route::get('users/{user}', [UsersController::class, 'show'])->name('viewUser');
Route::put('users/{user}', [UsersController::class, 'update']);
Route::delete('users/{user}', [UsersController::class, 'destroy']);


Route::get('locations/', [LocationsController::class, 'view'])->name('viewLocations');
Route::get('locations/{location}', [LocationsController::class, 'show'])->name('viewLocation');
Route::put('locations/{location}', [LocationsController::class, 'update']);
Route::delete('locations/{location}', [LocationsController::class, 'destroy']);

Route::get('drivers/', [DriversController::class, 'view'])->name('viewDrivers');
Route::get('drivers/{driver}', [DriversController::class, 'show'])->name('viewDriver');
Route::put('drivers/{driver}', [DriversController::class, 'update']);
Route::delete('drivers/{driver}', [DriversController::class, 'destroy']);

