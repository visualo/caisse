<?php

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
    return view('welcome');
});


Route::group(['middleware' => 'auth'], function() {
    Route::group(['prefix' => 'admin'], function () {
        Route::group(['prefix' => 'caisse'], function () {
//            Route::get('/', [App\Http\Controllers\Caisse\CaisseController::class, 'index'])->name('caisse');
        });

        Route::group(['prefix' => 'operation'], function () {
            Route::get('/', [App\Http\Controllers\Operation\OperationController::class, 'index'])->name('operation');
            Route::post('add', [App\Http\Controllers\Operation\OperationController::class, 'store'])->name('operation.add');
            Route::get('/{id}/edit', [App\Http\Controllers\Operation\OperationController::class, 'index'])->name('operation.edit');
            Route::post('{id}/view', [App\Http\Controllers\Operation\OperationController::class, 'view'])->name('operation.view');
            Route::post('edit', [App\Http\Controllers\Operation\OperationController::class, 'edit'])->name('operation.update');
        });

        Route::group(['prefix' => 'dashboard'], function () {
            Route::get('/', [App\Http\Controllers\Dashboard\DashboardController::class, 'index'])->name('dashboard');
            Route::get('list', [App\Http\Controllers\Dashboard\DashboardController::class, 'list_operations'])->name('dashboard.list');
            Route::delete('{id}/delete', [App\Http\Controllers\Dashboard\DashboardController::class, 'delete'])->name('dashboard.delete');
            Route::get('{periode}/view', [App\Http\Controllers\Dashboard\DashboardController::class, 'periode_operations'])->name('dashboard.view');

        });

        Route::group(['prefix' => 'operation'], function () {
            Route::delete('{id}/delete', [App\Http\Controllers\Operation\OperationController::class, 'delete'])->name('operation.delete');
        });

        Route::group(['prefix' => 'typeoperation'], function () {
            Route::get('/', [App\Http\Controllers\Typeoperation\TypeoperationController::class, 'index'])->name('typeoperation');
            Route::get('list', [App\Http\Controllers\Typeoperation\TypeoperationController::class, 'list_type_operations'])->name('typeoperation.list');
            Route::post('add', [App\Http\Controllers\Typeoperation\TypeoperationController::class, 'add'])->name('typeoperation.add');
            Route::post('edit', [App\Http\Controllers\Typeoperation\TypeoperationController::class, 'edit'])->name('typeoperation.edit');
            Route::delete('{id}/delete', [App\Http\Controllers\Typeoperation\TypeoperationController::class, 'delete'])->name('typeoperation.delete');
        });
                
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
