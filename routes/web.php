<?php


use App\Http\Controllers\CarsController;
use App\Http\Controllers\DirectionsController;
use App\Http\Controllers\DriversController;
use App\Http\Controllers\LocationsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
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


//Route::get('/', function () {
//    return view('index');
//});
/**
 * login routes
 */
Route::get('/', [AuthController::class, 'create'])->name('login');
Route::get('login/', [AuthController::class, 'create'])->name('login');
Route::post('login/', [AuthController::class, 'store'])->name('loginStore');

Route::get('directions/', [DirectionsController::class, 'show'])->name('viewDirections')->middleware('auth');
Route::post('directions', [DirectionsController::class, 'store'])->name('storeDirections')->middleware('auth');
Route::post('directions/update', [DirectionsController::class, 'updateIdle'])->name('updateIdle')->middleware('auth');


Route::post('logout/', [AuthController::class, 'destroy'])->name('logout');

Route::post('assign', [CarsController::class, 'assignDriver'])->name('assignDriver')->middleware('auth');

Route::get('shift/', [UsersController::class, 'endShift'])->name('endShift')->middleware('auth');

Route::group(['namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {


    Route::get('register/', function () {
        return view('register.create');
    });



    Route::post('register/', [RegisterController::class, 'create']);

    Route::get('administration/', function () {
        return view('admin.view');
    });


    Route::get('cars/', [CarsController::class, 'view'])->name('viewCars');
    Route::post('cars/', [CarsController::class, 'create']);
    Route::get('cars/{car}', [CarsController::class, 'show'])->name('viewCar');
    Route::patch('cars/{car}', [CarsController::class, 'update']);
    Route::delete('cars/{car}', [CarsController::class, 'destroy'])->name('deleteCar');


    Route::get('users/', [UsersController::class, 'view'])->name('viewUsers');
    Route::get('users/{user}', [UsersController::class, 'show'])->name('viewUser');
    Route::patch('users/{user}', [UsersController::class, 'update']);
    Route::delete('users/{user}', [UsersController::class, 'destroy'])->name('deleteUser');


    Route::get('locations/', [LocationsController::class, 'view'])->name('viewLocations');
    Route::post('locations/', [LocationsController::class, 'create']);
    Route::get('locations/{location}', [LocationsController::class, 'show'])->name('viewLocation');
    Route::patch('locations/{location}', [LocationsController::class, 'update']);
    Route::delete('locations/{location}', [LocationsController::class, 'destroy']);


    Route::get('drivers/', [DriversController::class, 'view'])->name('viewDrivers');
    Route::post('drivers/', [DriversController::class, 'create']);
    Route::get('drivers/{driver}', [DriversController::class, 'show'])->name('viewDriver');
    Route::patch('drivers/{driver}', [DriversController::class, 'update']);
    Route::delete('drivers/{driver}', [DriversController::class, 'destroy']);


});















