<?php


use App\Http\Controllers\BookingsController;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\DirectionsController;
use App\Http\Controllers\DriversController;
use App\Http\Controllers\LocationsController;
use App\Http\Controllers\ServicesController;
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

Route::get('bookings/', [BookingsController::class, 'view'])->name('viewBookings')->middleware('auth');
Route::get('bookings/{booking_id}', [BookingsController::class, 'viewBooking'])->name('viewBooking')->middleware('auth');
Route::post('bookings/{booking_id}', [BookingsController::class, 'refreshBooking'])->name('refreshBooking')->middleware('auth');
Route::put('bookings/{booking_id}', [BookingsController::class, 'updateBooking'])->name('updateBooking')->middleware('auth');
Route::delete('bookings/{booking}', [BookingsController::class, 'deleteBooking'])->name('deleteBooking')->middleware('auth');
Route::post('directions/scheduled', [BookingsController::class, 'store'])->name('storeBooking')->middleware('auth');


Route::get('directions/', [DirectionsController::class, 'show'])->name('viewDirections')->middleware('auth');
Route::post('directions', [DirectionsController::class, 'store'])->name('storeDirections')->middleware('auth');
Route::put('directions', [DirectionsController::class, 'update'])->name('updateDirections')->middleware('auth');
Route::post('directions/update', [DirectionsController::class, 'updateIdle'])->name('updateIdle')->middleware('auth');
Route::get('directions/driver/{driverID}', [DirectionsController::class, 'getDirection'])->name('allDirections')->middleware('auth');
Route::get('directions/single/{id}', [DirectionsController::class, 'getSingleDirection'])->name('getSingleDirection')->middleware('auth');


Route::post('logout/', [AuthController::class, 'destroy'])->name('logout');

Route::get('assign/', [CarsController::class, 'assignView'])->middleware('auth');
Route::post('assign', [CarsController::class, 'assignDriver'])->name('assignDriver')->middleware('auth');

Route::get('shift/', [UsersController::class, 'endShift'])->name('endShift')->middleware('auth');
Route::get('shift/driver/end', [UsersController::class, 'endShiftDriver'])->name('endShiftDriver')->middleware('auth');
Route::post('shift/driver/end', [UsersController::class, 'endShiftForDriver'])->name('endShiftForDriver')->middleware('auth');

Route::get('services/', [ServicesController::class, 'view'])->name('viewServices')->middleware('auth');
Route::post('service/fuel/', [ServicesController::class, 'addFuel'])->name('addFuel')->middleware('auth');

Route::group(['namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {


    Route::get('register/', function () {
        return view('register.create');
    });


    Route::post('register/', [RegisterController::class, 'create'])->name('registerUser');

    Route::get('administration/', function () {
        return view('admin.view');
    })->name('adminView');


    Route::post('/service/oil/', [ServicesController::class, 'changeOil'])->name('changeOil')->middleware('auth');
    Route::post('/service/tyre/', [ServicesController::class, 'changeTyre'])->name('changeTyre')->middleware('auth');
    Route::post('/service/registration/', [ServicesController::class, 'carRegistration'])->name('carRegistration')->middleware('auth');


    Route::get('administration/directions/', [DirectionsController::class, 'adminView'])->name('adminView');
    Route::post('administration/directions/', [DirectionsController::class, 'adminView'])->name('adminView');


    Route::get('cars/', [CarsController::class, 'view'])->name('viewCars');
    Route::post('cars/', [CarsController::class, 'create']);
    Route::get('cars/{car}', [CarsController::class, 'show'])->name('viewCar');
    Route::patch('cars/{car}', [CarsController::class, 'update']);
    Route::delete('cars/{car}', [CarsController::class, 'destroy'])->name('deleteCar');


    Route::get('users/', [UsersController::class, 'view'])->name('viewUsers');
    Route::get('users/{user}', [UsersController::class, 'show'])->name('viewUser');
    Route::put('users/{user}', [UsersController::class, 'update']);
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

    Route::get('companies/', [CompaniesController::class, 'view'])->name('viewCompanies');
    Route::post('companies/', [CompaniesController::class, 'create']);
    Route::get('companies/{company}', [CompaniesController::class, 'show'])->name('viewCompany');
    Route::patch('companies/{company}', [CompaniesController::class, 'update'])->name('updateCompany');
    Route::delete('companies/{company}', [CompaniesController::class, 'destroy'])->name('deleteCompany');


});















