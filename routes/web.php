<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PositionsController;
use App\Http\Controllers\SalariesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// Employees
Route::resource('employees', EmployeeController::class);

// Departments
Route::resource('departments', DepartmentsController::class);

// Positions
Route::resource('positions', PositionsController::class);

// Attendance
Route::resource('attendance', AttendanceController::class);

// Salaries
Route::resource('salaries', SalariesController::class);
