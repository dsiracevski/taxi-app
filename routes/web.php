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


/**
 * login routes
 */
Route::get('/', [AuthController::class, 'create'])->name('login');
Route::get('login/', [AuthController::class, 'create'])->name('login');
Route::post('login/', [AuthController::class, 'store'])->name('loginStore');

Route::get('bookings/', [BookingsController::class, 'view'])->name('viewBookings')->middleware('auth');
Route::get('bookings/get/all', [BookingsController::class, 'getBookings'])->name('getBookings')->middleware('auth');
Route::get('bookings/{booking_id}', [BookingsController::class, 'viewBooking'])->name('viewBooking')->middleware('auth');
Route::get('bookings/update/{booking_id}', [BookingsController::class, 'refreshBooking'])->name('refreshBooking')->middleware('auth');
Route::put('bookings/{booking_id}', [BookingsController::class, 'updateBooking'])->name('updateBooking')->middleware('auth');
Route::delete('bookings/{booking}', [BookingsController::class, 'deleteBooking'])->name('deleteBooking')->middleware('auth');


Route::get('directions/scheduled', [BookingsController::class, 'store'])->name('storeBooking')->middleware('auth');


Route::get('directions/', [DirectionsController::class, 'show'])->name('viewDirections')->middleware('auth');

Route::post('directions', [DirectionsController::class, 'store'])->name('storeDirections')->middleware('auth');
Route::put('directions', [DirectionsController::class, 'update'])->name('updateDirections')->middleware('auth');
Route::put('directions/archive/{direction}', [DirectionsController::class, 'archive'])->name('archiveDirection')->middleware('auth');
Route::put('directions/lock/{direction}', [DirectionsController::class, 'lock'])->name('lockDirection')->middleware('auth');
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
Route::post('/services/add', [ServicesController::class, 'addService'])->name('addService')->middleware('auth');

Route::group(['namespace' => 'Admin', 'middleware' => ['auth', 'admin']], function () {


    Route::get('register/', function () {
        return view('register.create');
    });


    Route::post('register/', [RegisterController::class, 'create'])->name('registerUser');

    Route::get('administration/', function () {
        return view('admin.view');
    })->name('adminView');

    Route::get('administration/shifts', [DriversController::class, 'viewShifts'])->name('viewShifts');
    Route::post('administration/shifts', [DriversController::class, 'viewShifts'])->name('viewShifts');

    Route::get('administration/directions/', [DirectionsController::class, 'adminView'])->name('adminView');
    Route::post('administration/directions/', [DirectionsController::class, 'adminView'])->name('adminView');


    Route::get('cars/{car}/services', [CarsController::class, 'showServices'])->name('showServices')->middleware('auth');
    Route::post('cars/{car}/services', [CarsController::class, 'showServices'])->name('showServices')->middleware('auth');
    Route::get('cars/', [CarsController::class, 'view'])->name('viewCars');
    Route::post('cars/', [CarsController::class, 'create'])->name('addCar');
    Route::get('cars/{car}', [CarsController::class, 'show'])->name('viewCar');
    Route::patch('cars/{car}', [CarsController::class, 'update'])->name('updateCar');
    Route::delete('cars/{car}', [CarsController::class, 'destroy'])->name('deleteCar');


    Route::get('users/', [UsersController::class, 'view'])->name('viewUsers');
    Route::get('users/{user}', [UsersController::class, 'show'])->name('viewUser');
    Route::put('users/{user}', [UsersController::class, 'update'])->name('editUser');
    Route::delete('users/{user}', [UsersController::class, 'destroy'])->name('deleteUser');


    Route::get('locations/', [LocationsController::class, 'view'])->name('viewLocations');
    Route::post('locations/', [LocationsController::class, 'create'])->name('createLocation');
    Route::get('locations/{location}', [LocationsController::class, 'show'])->name('viewLocation');
    Route::put('locations/{location}', [LocationsController::class, 'update'])->name('updateLocation');
    Route::delete('locations/{location}', [LocationsController::class, 'destroy'])->name('deleteLocation');


    Route::get('drivers/', [DriversController::class, 'view'])->name('viewDrivers');
    Route::post('drivers/', [DriversController::class, 'create'])->name('addDriver');
    Route::get('drivers/{driver}', [DriversController::class, 'show'])->name('viewDriver');
    Route::put('drivers/{driver}', [DriversController::class, 'update'])->name('updateDriver');
    Route::delete('drivers/{driver}', [DriversController::class, 'destroy'])->name('deleteDriver');

    Route::get('companies/', [CompaniesController::class, 'view'])->name('viewCompanies');
    Route::post('companies/', [CompaniesController::class, 'create'])->name('addCompany');
    Route::get('companies/{company}', [CompaniesController::class, 'show'])->name('viewCompany');
    Route::patch('companies/{company}', [CompaniesController::class, 'update'])->name('updateCompany');
    Route::delete('companies/{company}', [CompaniesController::class, 'destroy'])->name('deleteCompany');


});















