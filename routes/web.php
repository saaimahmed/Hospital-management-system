<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HMS2\DepartmentController;
use App\Http\Controllers\HMS2\DoctorController;
use App\Http\Controllers\HMS2\PatientController;
use App\Http\Controllers\HMS2\ScheduleController;
use App\Http\Controllers\HMS2\AppointmentController;


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
    Route::delete('/destroy/{id}','destroy')->name('patients.destroy');
    //soft delete
    Route::get('/soft-deletes','softDelete')->name('patients.soft-delete');
    Route::get('/restore/{id}','restore')->name('patients.restore');
    //Selected data delete
    Route::delete('/all-delete','selectedDelete')->name('patients.all-Delete');
    Route::get('/all-restore','allRestore')->name('patients.all-restore');
    //permanent force delete
    Route::delete('/permanent-delete/{id}','permanentDelete')->name('patients.permanent-delete');
    Route::post('/select-permanent-delete','selectPermanentDelete')->name('patients.select-permanent-delete');
});
//schedule Controller
Route::controller(ScheduleController::class)->prefix('schedules')->group(function (){
    Route::get('/index','index')->name('schedules.index');
    Route::post('/store','store')->name('schedules.store');
    Route::get('/edit/{id}','edit')->name('schedules.edit');
    Route::put('/update/{id}','update')->name('schedules.update');
    Route::get('/status/{id}','status')->name('schedules.status');
    Route::delete('/destroy/{id}','destroy')->name('schedules.destroy');
    //soft delete
    Route::get('/soft-deletes','softDelete')->name('schedules.soft-delete');
    Route::get('/restore/{id}','restore')->name('schedules.restore');
    //Selected data delete
    Route::delete('/all-delete','selectedDelete')->name('schedules.all-Delete');
    Route::get('/all-restore','allRestore')->name('schedules.all-restore');

    //permanent force delete
    Route::delete('/permanent-delete/{id}','permanentDelete')->name('schedules.permanent-delete');
    Route::post('/select-permanent-delete','selectPermanentDelete')->name('schedules.select-permanent-delete');
});
//Appointment Controller
Route::controller(AppointmentController::class)->prefix('appointments')->group(function (){
    Route::get('/index','index')->name('appointments.index');
    Route::post('/store','store')->name('appointments.store');
    Route::get('/edit/{id}','edit')->name('appointments.edit');
    Route::PUT('/update/{id}','update')->name('appointments.update');
    Route::post('/status/{id}','status')->name('appointments.status');
    Route::delete('/destroy/{id}','destroy')->name('appointments.destroy');




    Route::get('/get-patients','getPatients')->name('get.patients');
    Route::get('/get-doctor-name-list','getDoctorName')->name('get.doctors');
    Route::get('/get-department-name-list','getDepartmentName')->name('get.departments');
    Route::get('/get-schedules','getSchedules')->name('get.schedules');

});




