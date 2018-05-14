<?php

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

Route::get('/', [ 'uses'=>'HomeCtrl@index' ]);
Route::post('login', 'UserCtrl@do_login');
Route::get('logout', function() {
    Auth::logout();
    session()->flush();
    return redirect('/');
});

// middleware routes
Route::group([ 'prefix' => 'menus' ], function() {
    Route::get('/', [ 'uses' => 'MenuCtrl@index', 'middleware' => 'permission:menu_index' ]);
    Route::get('tree', [ 'uses' => 'MenuCtrl@tree', 'middleware' => 'permission:menu_index' ]);
    Route::post('save', [ 'uses' => 'MenuCtrl@store', 'middleware' => 'permission:menu_create' ]);
    Route::post('update', [ 'uses' => 'MenuCtrl@store', 'middleware' => 'permission:menu_update' ]);
    Route::get('delete', [ 'uses' => 'MenuCtrl@destroy', 'middleware' => 'permission:menu_delete' ]);
    Route::get('{type}/{id}', [ 'uses' => 'MenuCtrl@create', 'middleware' => 'permission:menu_create|menu_update' ]);
});

Route::group([ 'prefix' => 'roles' ], function() {
    Route::get('/', [ 'uses' => 'RoleCtrl@index', 'middleware' => 'permission:role_index' ]);
    Route::get('dt', [ 'uses' => 'RoleCtrl@dt', 'middleware' => 'permission:role_index' ]);
    Route::get('create/{id?}', [ 'uses' => 'RoleCtrl@create', 'middleware' => 'permission:role_create|role_update' ]);
    Route::get('tree', [ 'uses' => 'RoleCtrl@tree', 'middleware' => 'permission:role_create|role_update' ]);
    Route::post('save', [ 'uses' => 'RoleCtrl@store', 'middleware' => 'permission:role_create' ]);
    Route::post('update', [ 'uses' => 'RoleCtrl@store', 'middleware' => 'permission:role_update' ]);
    Route::get('delete/{id}', [ 'uses' => 'RoleCtrl@destroy', 'middleware' => 'permission:role_delete' ]);
});

Route::group([ 'prefix' => 'users' ], function() {
    Route::get('/', [ 'uses' => 'UserCtrl@index', 'middleware' => 'permission:user_index' ]);
    Route::get('dt', [ 'uses' => 'UserCtrl@dt', 'middleware' => 'permission:user_index' ]);
    Route::get('create/{id?}', [ 'uses' => 'UserCtrl@create', 'middleware' => 'permission:user_create|user_update' ]);
    Route::post('save', [ 'uses' => 'UserCtrl@store', 'middleware' => 'permission:user_create' ]);
    Route::post('update', [ 'uses' => 'UserCtrl@store', 'middleware' => 'permission:user_update' ]);
    Route::get('delete/{id}', [ 'uses' => 'UserCtrl@destroy', 'middleware' => 'permission:user_delete' ]);
});
