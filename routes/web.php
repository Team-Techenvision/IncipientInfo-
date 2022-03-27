<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\RestaurantController;


Route::redirect('/', '/login');

Route::redirect('/home', '/admin');

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () 
{
    Route::get('/', 'HomeController@index')->name('home');

    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');

    Route::resource('permissions', 'PermissionsController');

    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');

    Route::resource('roles', 'RolesController');

    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');

    Route::resource('users', 'UsersController');

    Route::resource('Restaurant', 'RestaurantController');

    Route::get('Restaurant-create', 'RestaurantController@create');

    // Route::post('admin/Add-Restaurant', 'RestaurantController@store');

    // Route::resource('/admin/Edit/{id}', 'RestaurantController@edit');

//     Route::put('/Edit/{id}', function ($id) 
//     {
//       echo $id;
// });

});
