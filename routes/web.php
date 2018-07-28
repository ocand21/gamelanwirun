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
Route::group(['middleware' => 'web'], function(){

  Route::get('produk', ['as' => 'viklan.index', 'uses' => 'Web\vIklanController@getIndex']);
  Route::get('produk/{url}', ['as' => 'viklan.single', 'uses' => 'Web\vIklanController@getSingle'])->where('url', '[\w\d\-\_]+');
  Route::post('produk/{iklan}/favourites', 'Web\vIklanController@store')->name('produk.fav.store');
  Route::delete('produk/{iklan}/favourites', 'Web\vIklanController@destroyFavourites')->name('produk.fav.destroy');

  Route::get('iklan/favourites', ['as' => 'viklan.favourites', 'uses' => 'Web\vIklanController@getFavourites']);

  Route::get('iklans', [
    'as' => 'iklans.index',
    'middleware' => 'roles',
    'roles' => ['seller'],
    'uses' => 'Web\IklanController@index'
  ]);
  Route::get('iklans/create', [
    'as' => 'iklans.create',
    'middleware' => 'roles',
    'roles' => ['seller'],
    'uses' => 'Web\IklanController@create'
  ]);
  Route::post('iklans', [
    'as' => 'iklans.store',
    'middleware' => 'roles',
    'roles' => ['seller'],
    'uses' => 'Web\IklanController@store'
  ]);
  Route::match(['put', 'patch'], 'iklans/{iklan}', [
    'as' => 'iklans.update',
    'middleware' => 'roles',
    'roles' => ['seller'],
    'uses' => 'Web\IklanController@update'
  ]);
  Route::delete('iklans/{iklan}', [
    'as' => 'iklans.destroy',
    'middleware' => 'roles',
    'roles' => ['seller'],
    'uses' => 'Web\IklanController@destroy'
  ]);
  Route::get('iklans/{iklan}', [
    'as' => 'iklans.show',
    'middleware' => 'roles',
    'roles' => ['seller'],
    'uses' => 'Web\IklanController@show'
  ]);
  Route::get('iklans/{iklan}/edit', [
    'as' => 'iklans.edit',
    'middleware' => 'roles',
    'roles' => ['seller'],
    'uses' => 'Web\IklanController@edit'
  ]);
  Route::delete('iklans/{iklans}/delimg1', [
    'as' => 'iklans.delimage1',
    'middleware' => 'roles',
    'roles' => ['seller'],
    'uses' => 'Web\PhotosController@delImage1'
  ]);
  Route::delete('iklans/{iklans}/delimg2', [
    'as' => 'iklans.delimage2',
    'middleware' => 'roles',
    'roles' => ['seller'],
    'uses' => 'Web\PhotosController@delImage2'
  ]);
  Route::delete('iklans/{iklans}/delimg3', [
    'as' => 'iklans.delimage3',
    'middleware' => 'roles',
    'roles' => ['seller'],
    'uses' => 'Web\PhotosController@delImage3'
  ]);
  Route::delete('iklans/{iklans}/delimg4', [
    'as' => 'iklans.delimage4',
    'middleware' => 'roles',
    'roles' => ['seller'],
    'uses' => 'Web\PhotosController@delImage4'
  ]);
  Route::delete('iklans/{iklans}/delimg5', [
    'as' => 'iklans.delimage5',
    'middleware' => 'roles',
    'roles' => ['seller'],
    'uses' => 'Web\PhotosController@delImage5'
  ]);


  Route::resource('photos', 'Web\PhotosController', [
    'except' => ['index', 'create', 'show', 'edit', 'update', 'store']
  ]);


  Route::resource('category', 'Web\CategoryController');


  Route::get('seller', [
    'as' => 'seller.index',
    'uses' => 'Web\SellerController@index',
    'middleware' => 'roles',
    'roles' => ['admin']
  ]);
  Route::post('seller', [
    'as' => 'seller.store',
    'uses' => 'Web\SellerController@store',
    'middleware' => 'roles',
    'roles' => ['admin']
  ]);
  Route::get('seller/create', [
    'as' => 'seller.create',
    'uses' => 'Web\SellerController@create',
    'middleware' => 'roles',
    'roles' => ['admin']
  ]);


  // Authentication Routes
  $this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
  $this->post('login', 'Auth\LoginController@login');
  $this->post('logout', 'Auth\LoginController@logout')->name('logout');

  // Password Reset Routes...
  $this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
  $this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
  $this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
  $this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.reset.post');

  Route::get('logout', 'Auth\LoginController@logout');

  Route::get('profil/changePassword', ['as' => 'auth.profil.changePassword', 'uses' => 'Web\ProfilController@showChangePasswordForm']);
  Route::post('profil/changePassword', ['as' => 'auth.profil.changePassword', 'uses' => 'Web\ProfilController@changePassword']);
  Route::get('profil/{id}', ['as' => 'auth.profil.show', 'uses' => 'Web\ProfilController@getProfile'])->where('id', '[\w\d\-\_]+');
  Route::get('profil/{id}/edit', ['as' => 'auth.profil.edit', 'uses' => 'Web\ProfilController@edit'])->where('id','[\w\d\-\_]+');
  Route::match(['put', 'patch'], 'profil/{id}', ['as' => 'auth.profil.update', 'uses' => 'Web\ProfilController@update'])->where('id','[\w\d\-\_]+');

  Route::get('/', [
    'uses' => 'Web\HomeController@index',
    'middleware' => 'roles',
    'roles' => ['admin', 'seller']
    ])->name('home');


});


  Route::get('forbidden', [
    'uses' => 'Web\ErrorController@getError',
    'as' => 'error.forbidden'
  ]);
