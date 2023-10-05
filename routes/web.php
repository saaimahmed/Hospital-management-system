<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HMS2\DepartmentController;
use App\Http\Controllers\HMS2\UnionController;
use App\Http\Controllers\HMS2\DoctorController;



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
    Route::post('/store','store')->name('departments.store');
    Route::get('/edit/{id}','edit')->name('departments.edit');
    Route::put('/update/{id}','update')->name('departments.update');
    Route::get('/status/{id}','status')->name('departments.status');
    Route::delete('/destroy/{id}','destroy')->name('departments.destroy');
});
// Doctor Controller
Route::controller(DoctorController::class)->prefix('doctors')->group(function (){
    Route::get('/index','index')->name('doctors.index');
    Route::post('/store','store')->name('doctors.store');
    Route::get('/edit/{id}','edit')->name('doctors.edit');
    Route::put('/update/{id}','update')->name('doctors.update');
    Route::get('/status/{id}','status')->name('doctors.status');
});


//union controller

Route::controller(UnionController::class)->prefix('unions')->group(function (){
    Route::get('/index','index')->name('unions.index');


});


