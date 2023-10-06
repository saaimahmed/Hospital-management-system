<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HMS2\DepartmentController;
use App\Http\Controllers\HMS2\DoctorController;
use App\Http\Controllers\HMS1\PatientController;
use App\Http\Controllers\HMS2\ScheduleController;


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
    Route::delete('/destroy/{id}','destroy')->name('doctors.destroy');
    //soft delete
    Route::get('/soft-deletes','softDelete')->name('doctors.soft-delete');
    Route::get('/restore/{id}','restore')->name('doctors.restore');
    //Selected data delete
    Route::delete('/all-delete','selectedDelete')->name('doctors.all-Delete');
    Route::get('/all-restore','allRestore')->name('doctors.all-restore');
    //permanent force delete
    Route::delete('/permanent-delete/{id}','permanentDelete')->name('doctors.permanent-delete');
    Route::post('/select-permanent-delete','selectPermanentDelete')->name('doctors.select-permanent-delete');
});

//patient controller
Route::controller(PatientController::class)->prefix('patients')->group(function (){
    Route::get('/index','index')->name('patients.index');
    Route::post('/store','store')->name('patients.store');
    Route::get('/edit/{id}','edit')->name('patients.edit');
    Route::put('/update/{id}','update')->name('patients.update');
});
//schedule Controller
Route::controller(ScheduleController::class)->prefix('schedules')->group(function (){
    Route::get('/index','index')->name('schedules.index');
    Route::post('/store','store')->name('schedules.store');
});



