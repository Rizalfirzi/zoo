<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\TicketReservationController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::post('/reservation', [TicketReservationController::class, 'store'])->name('reservation.store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Grup middleware untuk guest
Route::middleware('guest')->group(function () {
    // Rute utama yang mengarahkan ke halaman login
    Route::get('/', function () {
        return redirect()->route('landing_page');
    });
    // Route::get('/reload-captcha', [LoginController::class, 'reloadCaptcha'])->name('reloadCaptcha');
    Route::get('login', [LoginController::class, 'login'])->name('login');
    Route::post('login', [LoginController::class, 'loginAction'])->name('login.action');
});
Route::get('landing_page', [IndexController::class,'index'])->name('landing_page');


Route::group(['middleware' => ['auth']], function () {

});
Route::group(['middleware' => ['web', 'auth', 'verified']], function () {
    Route::get('get_notification/sidang', [NotificationController::class,'sidang'])->name('get_notification.sidang');
    Route::get('get_notification/vermin', [NotificationController::class,'vermin'])->name('get_notification.vermin');
    Route::get('get_notification/vermat', [NotificationController::class,'vermat'])->name('get_notification.vermat');
    Route::get('landing_page/detail/{id}', [IndexController::class, 'detailCity'])->name('landing_page.detail');
    Route::get('landing_page/detail-teradu/{amar}', [IndexController::class, 'detailTeradu'])->name('landing_page.detail-teradu');
    Route::get('home', [LoginController::class, 'login'])->name('home');
    Route::get('/default', function () {
        return view('welcome'); // return view('admin.layouts.main');
    });


    Route::group(['prefix' => 'dashboard',], function() {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/modal/show/{province_name}', [DashboardController::class, 'show'])->name('dashboard.modal.show');
        Route::get('/modal/show-pemeriksaan/{month}', [DashboardController::class, 'showDetailSidangPemeriksaan'])->name('dashboard.modal.show-sidang_pemeriksaan');
        Route::get('/modal/show-putusan/{month}', [DashboardController::class, 'showDetailSidangPutusan'])->name('dashboard.modal.show-sidang_putusan');
    });
    Route::prefix('user')->group(function () {
        Route::group(['prefix' => 'profile'], function() {
            Route::get('/', [UserProfileController::class, 'index'])->name('profile');
        });
    });

    Route::get('/settings', [UserManagementController::class, 'index'])->name('settings');
    Route::group(['prefix' => 'settings', 'as' => 'settings.'], function() {
        Route::group(['prefix' => 'user'], function() {
            Route::get('/', [UserManagementController::class, 'index'])->name('user');
            Route::get('create', [UserManagementController::class, 'create'])->name('user.create');
            Route::post('store', [UserManagementController::class, 'store'])->name('user.store');
            Route::get('edit/{id}', [UserManagementController::class, 'edit'])->name('user.edit');
            Route::post('update', [UserManagementController::class, 'update'])->name('user.update');
            Route::post('destroy', [UserManagementController::class, 'destroy'])->name('user.destroy');
        });
        Route::group(['prefix' => 'role'], function() {
            Route::get('/', [RoleController::class, 'index'])->name('role');
            Route::get('create', [RoleController::class, 'create'])->name('role.create');
            Route::post('store', [RoleController::class, 'store'])->name('role.store');
            Route::get('edit/{id}', [RoleController::class, 'edit'])->name('role.edit');
            Route::get('show/{id}/{user_id}', [RoleController::class, 'show'])->name('role.show');
            Route::post('update', [RoleController::class, 'update'])->name('role.update');
            Route::post('destroy', [RoleController::class, 'destroy'])->name('role.destroy');
        });
        Route::group(['prefix' => 'permission'], function() {
            Route::get('/', [PermissionController::class, 'index'])->name('permission');
            Route::get('create', [PermissionController::class, 'create'])->name('permission.create');
            Route::post('store', [PermissionController::class, 'store'])->name('permission.store');
            Route::get('edit/{id}', [PermissionController::class, 'edit'])->name('permission.edit');
            Route::get('show/{id}', [PermissionController::class, 'show'])->name('permission.show');
            Route::post('update', [PermissionController::class, 'update'])->name('permission.update');
            Route::post('destroy', [PermissionController::class, 'destroy'])->name('permission.destroy');
        });
    });

});




