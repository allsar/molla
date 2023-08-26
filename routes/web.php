<?php

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
Route::get('/admin', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
Route::get('/categories', [\App\Http\Controllers\CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [\App\Http\Controllers\CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories/store', [\App\Http\Controllers\CategoryController::class, 'store'])->name('categories.store');
Route::delete('/categories/delete/{id}', [\App\Http\Controllers\CategoryController::class, 'delete'])->name('categories.delete');
Route::get('/categories/edit/{id}', [\App\Http\Controllers\CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/categories/update/{id}', [\App\Http\Controllers\CategoryController::class, 'update'])->name('categories.update');
Route::get('/copy', [\App\Http\Controllers\CopyController::class, 'index'])->name('copy.index');
Route::post('/copy/store', [\App\Http\Controllers\CopyController::class, 'store'])->name('copy.store');
Route::put('/copy/update/{id?}', [\App\Http\Controllers\CopyController::class, 'update'])->name('copy.update');
Route::get('/manufacture', [\App\Http\Controllers\ManufactureController::class, 'index'])->name('manufacture.index');
Route::post('/manufacture/store', [\App\Http\Controllers\ManufactureController::class, 'store'])->name('manufacture.store');
Route::put('/manufacture/update/{id?}', [\App\Http\Controllers\ManufactureController::class, 'update'])->name('manufacture.update');
