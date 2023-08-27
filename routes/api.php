<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/categories/data', [\App\Http\Controllers\CategoryController::class, 'getData'])->name('categories.data');
Route::get('/category/update/{id?}', [\App\Http\Controllers\CategoryController::class, 'getUpdate'])->name('category.get-update');
Route::get('/copy/data', [\App\Http\Controllers\CopyController::class, 'getData'])->name('copy.data');
Route::get('/copy/update/{id?}', [\App\Http\Controllers\CopyController::class, 'getUpdate'])->name('copy.get-update');
Route::get('/manufacture/data', [\App\Http\Controllers\ManufactureController::class, 'getData'])->name('manufacture.data');
Route::delete('/manufacture/delete/{id?}', [\App\Http\Controllers\ManufactureController::class, 'delete'])->name('manufacture.delete');
Route::get('/features/data', [\App\Http\Controllers\FeatureController::class, 'getData'])->name('features.data');
Route::delete('/features/delete/{id?}', [\App\Http\Controllers\FeatureController::class, 'delete'])->name('features.delete');
