<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


Route::middleware(['authMiddleware'])->group(function () {

    Route::prefix('/dashboard')->name('admin.')->group(function () {

        Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

        Route::resource('tasks', TaskController::class)->names([
            'index' => 'tasks.index',
            'create' => 'tasks.create',
            'store' => 'tasks.store',
            'show' => 'tasks.show',
            'edit' => 'tasks.edit',
            'update' => 'tasks.update',
            'destroy' => 'tasks.destroy',
        ]);
    });
});


Route::match(['get', 'post'], 'login', function (Request $request) {
    if (Auth::check()) {
        return redirect()->route('admin.dashboard');
    }
    return app(AuthController::class)->login($request);
})->name('auth.login');

// Register Route
Route::match(['get', 'post'], 'register', function (Request $request) {
    if (Auth::check()) {
        return redirect()->route('admin.dashboard');
    }
    return app(AuthController::class)->register($request);
})->name('auth.register');


Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');


Route::fallback(function () {
    abort(404);
});
