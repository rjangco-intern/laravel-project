<?php
use Illuminate\Http\Request;
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
    return view('login');
});

Route::group(['prefix'  =>  'admin'], function () {

    Route::get('login', 'UserController@showLoginForm')->name('admin.login');
    Route::post('login', 'UserController@login')->name('admin.login.post');
    Route::get('logout', 'UserController@logout')->name('admin.logout');
    Route::get('dashboard', 'UserController@showDashboard')->name('admin.dashboard');

        Route::group(['prefix'  =>   'products'], function() {

            Route::get('/', 'ProductController@index')->name('admin.products.index');
            Route::get('/insert','ProductController@showCreateForm')->name('admin.products.insert');
            Route::POST('/create','ProductController@create')->name('admin.products.create');
			Route::get('/{id}/edit/', 'ProductController@edit')->name('admin.products.edit');
            Route::patch('/{id}/edit/', 'ProductController@update')->name('admin.products.update');
            Route::delete('/{id}/delete', 'ProductController@destroy')->name('admin.products.delete');
            	Route::group(['prefix'  =>   'products'], function() {

            		Route::get('/', 'CategoryController@index')->name('admin.categories.index');
            		Route::get('/insert','CategoryController@showCreateForm')->name('admin.categories.insert');
            		Route::POST('/create','CategoryController@create')->name('admin.categories.create');
            		Route::get('/{id}/edit/', 'CategoryController@edit')->name('admin.categories.edit');
            		Route::patch('/{id}/edit/', 'CategoryController@update')->name('admin.categories.update');
            		Route::delete('/{id}/delete', 'CategoryController@destroy')->name('admin.categories.delete');



        		});

        });

});
