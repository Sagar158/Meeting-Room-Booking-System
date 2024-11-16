<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\CitiesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CountriesController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MeetingController;

Route::controller(MeetingController::class)->name('meetings.')->group(function(){
    Route::get('/','index')->name('index');
    Route::get('/meetings/details/{id}',  'getMeetingDetails')->name('details');
    Route::get('/meetings/events',  'fetchEvents')->name('events');
    Route::post('/meetings/store',  'store')->name('store');
});
Route::get('employees/fetchData', [EmployeeController::class,'fetchData'])->name('employees.fetchData');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth'])->group(function(){
    Route::controller(EmployeeController::class)->prefix('employees')->name('employees.')->group(function(){
        Route::get('/','index')->name('index');
        Route::get('create','create')->name('create');
        Route::post('/store','store')->name('store');
        Route::get('{employeeId}/edit','edit')->name('edit');
        Route::post('{employeeId}/update','update')->name('update');
        Route::post('{employeeId}/destroy','destroy')->name('destroy');
        Route::get('fetch', 'fetch')->name('fetch');
    });

    Route::controller(DesignationController::class)->prefix('designations')->name('designations.')->group(function(){
        Route::get('fetch','fetchDesignation')->name('fetch');
    });

    Route::controller(DepartmentController::class)->prefix('departments')->name('departments.')->group(function(){
        Route::get('fetch','fetchDepartment')->name('fetch');
    });

    Route::controller(CountriesController::class)->prefix('countries')->name('countries.')->group(function(){
        Route::get('fetch','fetchCountries')->name('fetch');
    });

    Route::controller(CitiesController::class)->prefix('cities')->name('cities.')->group(function(){
        Route::get('/fetch','fetchCities')->name('fetch');
    });

    Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->group(function(){
        Route::get('/profile',  'edit')->name('edit');
        Route::patch('/profile',  'update')->name('update');
    });

    Route::get('theme/change/{theme}',[ThemeController::class,'changeTheme'])->name('theme.change');


});


require __DIR__.'/auth.php';
