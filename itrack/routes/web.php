<?php

use App\Http\Controllers\ActivityLogController;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\StockingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ItemIssuingsController;

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

Route::get('/', [DashboardController::class, 'index'])->name("home");
Route::get('/login', [LoginController::class, 'showLoginForm']);
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::resources([
    'items' => ItemsController::class,
    'stocks' => StockingController::class,
    'issuings' => ItemIssuingsController::class,
    'users' => UsersController::class,
]);

Route::patch('users/block/{user}', [UsersController::class, 'blockUser'])->name('block_user');

Route::get('create_superuser', function () {
    User::create(
        [
            'name' => 'Admin',
            'designation' => 'IT Technician',
            'email' => 'superadmin@admin.com',
            'password' => \Illuminate\Support\Facades\Hash::make('admin'),

        ]
    );
});

Route::get('/activity_logs', [ActivityLogController::class, 'index'])->name('logs');
Route::post('/activity_logs/clear_all', [ActivityLogController::class, 'clearAllLogs'])->name('logs.clear_all');


//Route::view('/items/{path?}/{other?}', 'items.index');
//Route::view('/stockings/{path?}/{other?}', 'stocks.index');

//Route::view('/users/{path?}/{other?}', 'users.index');


//Route::get('/get_items', [ItemsController::class, 'get_items']);
//Route::patch('/items/{id}/toggle_status', [ItemsController::class, 'toggle_status']);
