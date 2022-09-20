<?php

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

Route::get('/', function () {
    return view('layouts.app');
});

Route::get('/visech-login', function () {
    return view('backend.auth.login');
});

Auth::routes();

//Custom Authentication Sign in routes
Route::group(['prefix' => 'dashboard', 'namespace' => 'App\Http\Controllers\backend'], function(){

    Route::get('/home', 'HomeController@index')->name('dashboard.home');

    // .rand(123456,999999)

    // Permissions
    Route::get('/permissions', 'Auth\PermissionController@allPermissions')->name('permissions.index');
    // Add Permission
    Route::get('/add-permission', 'Auth\PermissionController@addPermission')->name('permissions.create');
    Route::post('/add-permission', 'Auth\PermissionController@storePermission')->name('permissions.store');
    // Edit Permission
    Route::get('/edit-permission/{id}', 'Auth\PermissionController@editPermission')->name('permissions.edit');
    Route::put('/edit-permission/{id}', 'Auth\PermissionController@updatePermission')->name('permissions.update');
    // Delete Permission
    Route::get('/delete-permission/{id}', 'Auth\PermissionController@destroyPermission')->name('permission.destroy');

    
    // Roles
    Route::get('/roles', 'Auth\RoleController@allRoles')->name('roles.index');
    // Add Roles
    Route::get('/add-role', 'Auth\RoleController@addRole')->name('roles.create');
    Route::post('/add-role', 'Auth\RoleController@storeRole')->name('roles.store');
    // Edit Roles
    Route::get('edit-role/{id}', 'Auth\RoleController@editRole')->name('role.edit');
    Route::put('edit-role/{id}', 'Auth\RoleController@updateRole')->name('role.update');
    // Delete Role
    Route::get('delete-role/{id}', 'Auth\RoleController@destroyRole')->name('del.role');


    // Accounts
    Route::get('/accounts', 'Auth\AccountController@allAccounts')->name('all.accounts');
    // Add Account
    Route::get('/add-account', 'Auth\AccountController@addAccount')->name('accounts.create');
    Route::post('/add-account', 'Auth\AccountController@storeAccount')->name('accounts.store');
    // Edit Account
    Route::get('/edit-account/{id}', 'Auth\AccountController@accountEdit')->name('accounts.edit');
    Route::put('/edit-account/{id}', 'Auth\AccountController@accountUpdate')->name('accounts.update');
    // Delete Account
    Route::get('/delete-account/{id}', 'Auth\AccountController@accountDestroy')->name('accountDestroy');
});


Route::get('/sign-in', 'App\Http\Controllers\backend\Auth\LoginController@showLoginForm')->name('company.login');
Route::post('/sign-in', 'App\Http\Controllers\backend\Auth\LoginController@login');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
