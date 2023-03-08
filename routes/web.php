<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileViewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
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

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

Route::get('/register', [RegisterController::class, 'showBuyForm'])->name('register.buy');
Route::get('/register/{key}', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register_process', [RegisterController::class, 'register'])->name('register.process');

Route::get('/profile/{key}', [ProfileViewController::class, 'viewProfileByUnitedKey'])->name('profile.view.key');
Route::get('/profile/inner/{id}', [ProfileViewController::class, 'viewProfileByID'])->name('profile.view.id');

Route::post('/profile/download', [ProfileViewController::class, 'downloadProfile'])->name('profile.download');

Auth::routes();

Route::get('/home', [ProfileController::class, 'get'])->name('profile.get');

Route::post('/update_flag', [ProfileController::class, 'updateFlag'])->name('profile.update.flag');
Route::post('/update_property', [ProfileController::class, 'updateProperty'])->name('profile.update.property');
Route::post('/update_sns_property', [ProfileController::class, 'updateSnsProperty'])->name('profile.update.sns.property');
Route::post('/update_image', [ProfileController::class, 'updateImage'])->name('profile.update.image');


Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/user/list', [AdminController::class, 'userListData'])->name('admin.user.list.data');
    Route::post('/user/delete', [AdminController::class, 'delete'])->name('admin.user.delete');

    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.info');
    Route::post('/profile/update', [AdminController::class, 'updateProfile'])->name('admin.info.update');
}); 