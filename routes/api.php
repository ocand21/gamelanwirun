<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
 //   return $request->user();
//});

Route::group(['prefix' => 'v1', 'middleware' => 'cors'], function(){

	Route::resource('category', 'Api\ApiCategoryController', [
		'except' => ['create', 'edit', 'store', 'update', 'destroy']
	]);

	Route::resource('iklan', 'Api\ApiIklanController', [
		'except' => ['create', 'edit', 'store', 'update', 'destroy']
	]);

	Route::resource('wishlist', 'Api\ApiWishlistController', [
		'except' => ['create', 'edit', 'show', 'update']
	]);

	Route::post('iklan/{iklan}/favourites', [
		'uses' => 'Api\ApiVIklanController@storeFavourites'
	])->name('iklan.fav.store');

	Route::get('iklan/favourites', [
		'uses' => 'Api\ApiVIklanController@getFavourites'
	]);

	Route::match(['put', 'patch'], 'iklan/{iklan}/countview', [
		'uses' => 'Api\ApiIklanController@viewCount'
	]);

	Route::match(['put', 'patch'], 'iklan/{iklan}/contactcount', [
		'uses' => 'Api\ApiIklanController@contactCount'
	]);

	Route::get('iklan/category/{categories}', [
		'uses' => 'Api\ApiVIklanController@getCategory'
	]);

	Route::post('/user/register', [
		'uses' => 'Api\AuthController@store'
	]);

	Route::post('/user/signin', [
		'uses' => 'Api\AuthController@signin'
	]);

	Route::post('recover', [
		'uses' => 'Api\AuthController@recover']);

	Route::post('/user/changePassword', [
		'uses' => 'Api\ApiProfilController@changepassword'
	]);

	Route::get('/user/myprofile', [
		'uses' => 'Api\ApiProfilController@getProfile'
	]);

	Route::post('/user/myprofile', [
		'uses' => 'Api\ApiProfilController@editProfile'
	]);

	Route::get('/user/myiklan', [
		'uses' => 'Api\ApiIklanController@myIklans'
	]);

	Route::get('/user/profile/{id}', [
		'uses' => 'Api\ApiProfilController@publicProfile'
	]);

	// Route::match(['put', 'patch'], '/user/profil/{id}', [
	// 	'uses' => 'ApiProfilController@editProfile'
	// ]);

});
