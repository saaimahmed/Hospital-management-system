<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\dashboardController;
use App\Http\Controllers\DepartmentController;
/*
|--------------------------------------------------------------------------
| Nadim Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[dashboardController::class,'home'])->name('home');
Route::get('/departments/index',[DepartmentController::class,'index'])->name('departments.index');
