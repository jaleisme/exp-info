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

    //Base Academic
    Route::get('/academic', function(){
        return redirect()->route('base-class.index');
    })->name('academic');
    Route::group(['prefix' => 'academic'], function () {
        //Class Management
        Route::resource('base-class', 'Superadmin\BaseClassController');
    });

    //Base System Access
    Route::get('/system-access', function(){
        return redirect()->route('administrator.index');
    })->name('system-access');
    Route::group(['prefix' => 'system-access'], function () {
        //Administrator
        Route::resource('administrator', 'Superadmin\AdminController');

        //Administrator
        Route::resource('user', 'Superadmin\UserController');

    });
});
