<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PagesController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Site\HomeController as SiteHomeController;
use App\Http\Controllers\Site\PageController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Profiler\Profile;

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

Route::get('/', [SiteHomeController::class, 'index']);

Route::prefix('painel')->group(function(){
    
    /** CONTROLLER HOME */
    Route::get('/', [HomeController::class, 'index'])->name('admin');
    
    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'authenticate']);

    Route::get('register', [RegisterController::class, 'index'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);

    Route::post('logout', [LoginController::class, 'logout']);

    /** CONTROLLER USER */
    Route::resource('users', UserController::class);

    /** CONTROLLER PROFILE */
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');

    /** CONTROLLER SETTINGS */
    Route::get('settings', [SettingsController::class, 'index'])->name('settings');
    Route::put('settingssave', [SettingsController::class, 'save'])->name('settings.save');

    /** CONTROLLER USER */
    Route::resource('pages', PagesController::class);
});

Route::fallback([PageController::class, 'index']);