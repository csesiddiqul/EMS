<?php

use Illuminate\Support\Facades\Route;
use App\Models\Employee;
use App\Models\Admin;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@redirectAdmin')->name('index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('getdslist','Backend\DesignationController@getDesList');

//Route::post('createem',[\App\Http\Controllers\Backend\AdminsController::class,'employeesStore'])->name('emcreagte');

Route::get('lol',function (){
     $em =  Employee::find(2);

     $dta  = Admin::find(6)->employee;

     return $dta;
});

/**
 * Admin routes
 */
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', 'Backend\DashboardController@index')->name('admin.dashboard');
    Route::resource('roles', 'Backend\RolesController', ['names' => 'admin.roles']);
    Route::resource('users', 'Backend\UsersController', ['names' => 'admin.users']);
    Route::resource('admins', 'Backend\AdminsController', ['names' => 'admin.admins']);

    //employees
    Route::resource('employees', 'Backend\EmployeeController', ['names' => 'admin.employees']);
    Route::resource('departments', 'Backend\DepartmentController', ['names' => 'admin.departments']);
    Route::resource('designations', 'Backend\DesignationController', ['names' => 'admin.designations']);



    // Login Routes
    Route::get('/login', 'Backend\Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login/submit', 'Backend\Auth\LoginController@login')->name('admin.login.submit');

    // Logout Routes
    Route::post('/logout/submit', 'Backend\Auth\LoginController@logout')->name('admin.logout.submit');

    // Forget Password Routes
    Route::get('/password/reset', 'Backend\Auth\ForgetPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset/submit', 'Backend\Auth\ForgetPasswordController@reset')->name('admin.password.update');
});
