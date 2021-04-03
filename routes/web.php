<?php

use App\Http\Controllers\Api\AreaController;
use App\Http\Controllers\Api\AuthController as ApiAuthController;
use App\Http\Controllers\Api\MasterController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\MailController;
use App\Http\Controllers\Main\IndexController;
use App\Http\Controllers\Master\VaccinationController;
use App\Models\User;
use Illuminate\Routing\RouteGroup;
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

Route::get('/', function () {
    return redirect(route('login'));
});

Route::group(['prefix' => '/dashboard', 'middleware' => 'auth'], function () {
    Route::get('index', [IndexController::class, 'index']);
    Route::get('users', [IndexController::class, 'users']);
    Route::get('pattient', [IndexController::class, 'pattient']);
});

Route::group(['prefix' => '/auth'], function () {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::get('register', [AuthController::class, 'register']);
    Route::get('logout', [ApiAuthController::class, 'logout']);
});

Route::group(['prefix' => '/user', 'middleware' => 'auth'], function () {
    Route::get('profile', [IndexController::class, 'profile']);
    Route::get('register', [IndexController::class, 'register']);
    Route::get('refferal_patient/reg', [IndexController::class, 'refferal_patient']);
});


Route::group(['prefix' => '/master', 'middleware' => 'auth'], function () {
    Route::get('/type_of_vaccination', [VaccinationController::class, 'type']);
    Route::get('/hospital', [VaccinationController::class, 'hospital']);
    Route::get('/barcode', [VaccinationController::class, 'barcode']);
    Route::get('/barcode/print/{resource}', [VaccinationController::class, 'barcode_print']);
});

Route::prefix('api/v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('/login', [ApiAuthController::class, 'login']);
        Route::get('/logout', [ApiAuthController::class, 'logout']);
        Route::post('/register', [ApiAuthController::class, 'register']);
    });

    Route::prefix('register')->group(function () {
        Route::post('/profile', [UserController::class, 'profile_user']);
        Route::post('/referral/user', [UserController::class, 'referral_user']);
    });

    Route::prefix('area')->group(function () {
        Route::get('/regencies', [AreaController::class, 'regencies']);
        Route::get('/districts', [AreaController::class, 'districts']);
        Route::get('/villages', [AreaController::class, 'villages']);
    });

    Route::prefix('vaccination')->group(function () {
        Route::get('/type/get', [MasterController::class, 'get_type']);
        Route::get('/type/get/{id}', [MasterController::class, 'get_type']);
        Route::post('/type/insert', [MasterController::class, 'insert_type']);
        Route::put('/type/update', [MasterController::class, 'update_type']);
        Route::delete('/type/delete', [MasterController::class, 'delete_type']);

        Route::post('/refferal/insert', [MasterController::class, 'insert_refferal']);
        Route::post('/refferal/message', [MasterController::class, 'message_refferal']);
    });

    Route::prefix('hospital')->group(function () {
        Route::get('/get', [MasterController::class, 'get_hospital']);
        Route::get('/get/{id}', [MasterController::class, 'get_hospital']);
        Route::post('/insert', [MasterController::class, 'insert_hospital']);
        Route::post('/update', [MasterController::class, 'update_hospital']);
        Route::delete('/delete', [MasterController::class, 'delete_hospital']);
    });

    Route::prefix('pattient')->group(function () {
        Route::get('/get', [MasterController::class, 'get_pattient']);
        Route::get('/get/{id}', [MasterController::class, 'get_pattient']);
        Route::post('/insert', [MasterController::class, 'insert_pattient']);
        Route::post('/update', [MasterController::class, 'update_pattient']);
        Route::delete('/delete', [MasterController::class, 'delete_pattient']);
    });

    Route::prefix('refferal')->group(function () {
        Route::get('/get', [MasterController::class, 'get_refferal']);
        Route::get('/confirm', [MasterController::class, 'confirm_refferal']);
        Route::get('/get/{id}', [MasterController::class, 'get_refferal']);
        Route::post('/insert', [MasterController::class, 'insert_refferal']);
        Route::post('/update', [MasterController::class, 'update_refferal']);
        Route::delete('/delete', [MasterController::class, 'delete_refferal']);
    });

    Route::prefix('dashboard')->group(function () {
        Route::get('/index/get/pattient', [MasterController::class, 'dashboard_get_pattient']);
        Route::get('/index/get/status', [MasterController::class, 'dashboard_get_status']);
    });
});


Route::group(['prefix' => '/authentication/mail'], function () {
    Route::get('/{resource}', [MailController::class, 'activation']);
});

Route::group(['prefix' => '/error'], function () {
    Route::get('/invalid/token', function () {
        return view('main.error.token-invalid');
    });
});
