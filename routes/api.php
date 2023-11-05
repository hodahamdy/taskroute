<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\CategoryController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('categories')->name('categories.')->group( function () {

    Route::controller(CategoryController::class)->group( function () {
        Route::get('/index' , 'index')->name('index');
        // Route::get('/create' , 'create')->name('create');
        Route::post('/store' , 'store')->name('store');
        Route::get('/show/{id}' , 'show')->name('show');
        Route::post('/update/{id}' , 'update')->name('update');
        Route::get('/delete/{id}' , 'delete')->name('delete');
    });
});

// Route::resource('categories', CategoryController::class);
// Route::resource('tasks', TaskController::class);

// Route::post('/categories/store', [CategoryController::class, 'store']);



Route::prefix('task')->name('task.')->group( function () {

    Route::controller(TaskController::class)->group( function () {
        Route::get('/index' , 'index')->name('index');
        // Route::get('/create' , 'create')->name('create');
        Route::post('/store' , 'store')->name('store');
        Route::get('/show/{id}' , 'show')->name('show');
        Route::post('/update/{id}' , 'update')->name('update');
        Route::get('/delete/{id}' , 'delete')->name('delete');
    });
});


