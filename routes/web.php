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
    return redirect()->route('company.login');
});


Route::get('/profile', function () {
    return view('backend.auth.users.profile');
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
    // Change Password
    Route::get('/change-password/{id}', 'Auth\AccountController@newPass')->name('change.pass');
    Route::put('/change-password/{id}', 'Auth\AccountController@passChanged')->name('changed.pass');
    // Profile
    Route::get('/profile/{id}', 'Auth\ProfileController@getProfile')->name('account.profile');
    Route::put('/profile/{id}', 'Auth\ProfileController@updateMyProfile')->name('update.profile');


    // Shift
    Route::get('/shifts', 'attendance\ShiftController@allShifts')->name('shifts.index');
    // Add Shift
    Route::get('/add-shift', 'attendance\ShiftController@addShift')->name('shift.create');
    Route::post('/add-shift', 'attendance\ShiftController@shiftStore')->name('shift.store');
    // Edit Shift
    Route::get('/edit-shift/{id}', 'attendance\ShiftController@shiftEdit')->name('shift.edit');
    Route::put('/edit-shift/{id}', 'attendance\ShiftController@shiftUpdate')->name('shift.update');
    // Delete Shift
    Route::get('delete-shift/{id}', 'attendance\ShiftController@shiftDelete')->name('shift.destroy');

    //Attendance
    Route::get('/attendance', 'attendance\AttendanceController@markAttendance')->name('mark.in');
    Route::get('/check-in', 'attendance\AttendanceController@checkInStore')->name('mark.instore');
    Route::get('/check-out', 'attendance\AttendanceController@checkOut')->name('mark.outstore');

    //Network
    Route::get('/networks', 'NetworkController@allNetworks')->name('network.index');
    // Create Network
    Route::get('add-network', 'NetworkController@addNetwork')->name('network.create');
    Route::post('add-network', 'NetworkController@storeNetwork')->name('network.store');
    // Edit Network
    Route::get('/edit-network/{id}', 'NetworkController@editNetwork')->name('network.edit');
    Route::put('/edit-network/{id}', 'NetworkController@updateNetwork')->name('network.update');
    // Delete Network
    Route::get('/delete-network/{id}', 'NetworkController@destroyNetwork')->name('del.network');

});


Route::get('/sign-in', 'App\Http\Controllers\backend\Auth\LoginController@showLoginForm')->name('company.login');
Route::post('/sign-in', 'App\Http\Controllers\backend\Auth\LoginController@login');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
