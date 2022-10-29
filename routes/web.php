<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');
Route::resource('admin/company', CompanyController::class)->middleware('is_admin');
Route::get('admin/employee/{id}/delete', [EmployeeController::class, 'destroy'])->middleware('is_admin');
Route::get('admin/company/{id}/delete', [CompanyController::class, 'destroy'])->middleware('is_admin');
Route::resource('admin/employee', EmployeeController::class)->middleware('is_admin');

Route::middleware('auth:api')->group(function(){
    Route::get('employee', [ApiController::class,'authenticatedUserDetails']);
});