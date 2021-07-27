<?php

use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Auth::routes();

// Home
Route::get('/home', 'HomeController@index')->name('home');

// Profile
Route::get('/profile/{id}', 'HomeController@profile')->name('profile');
Route::post('/save-profile/{id}', 'HomeController@saveProfile')->name('save-profile');

// Base Roles Routes
Route::get('/superadmin', 'Superadmin\HomeController@index')->name('superadmin')->middleware('superadmin');
Route::get('/admin', 'Admin\HomeController@index')->name('admin')->middleware('admin');
Route::get('/user', 'User\HomeController@index')->name('user')->middleware('user');

// Superadmin's Routes
Route::group(['prefix' => 'superadmin', 'middleware' => 'superadmin'], function () {
    Route::group(['prefix' => 'system-access'], function () {
        //Base System Access
        Route::get('/system-access', function(){
            return redirect()->route('administrator');
        })->name('system-access');
        //Administrator
        Route::get('/administrator', 'Superadmin\AdminController@index')->name('administrator');
        Route::get('/administrator/create', 'Superadmin\AdminController@create')->name('administrator.create');
        Route::get('/administrator/edit/{id}', 'Superadmin\AdminController@edit')->name('administrator.edit');
        Route::put('/administrator/update/{id}', 'Superadmin\AdminController@update')->name('administrator.update');
        Route::post('/administrator/store', 'Superadmin\AdminController@store')->name('administrator.store');
        Route::delete('/administrator/delete/{id}', 'Superadmin\AdminController@destroy')->name('administrator.delete');
    });
});
