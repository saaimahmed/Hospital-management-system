<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;


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
//
Route::controller(DepartmentController::class)->prefix('departments')->group(function (){
    Route::get('/index','index')->name('departments.index');
});

