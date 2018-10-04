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

	Route::post('user/changepic', 'Api\ApiProfilController@changePicture');

	Route::get('iklan/photos', 'Api\ApiIklanController@getPhotos');

	Route::resource('category', 'Api\ApiCategoryController', [
		'except' => ['create', 'edit', 'store', 'update', 'destroy']
	]);

	Route::resource('iklan', 'Api\ApiIklanController', [
		'except' => ['create', 'edit', 'store', 'update', 'destroy']
	]);

	Route::get('iklanLog/{iklan}', 'Api\ApiIklanController@showIn');

	// if (Auth::guest()) {
	// 	Route::get('iklan/{iklan}', 'Api\ApiIklanController@show');
	// } else {
	// 	Route::get('iklan/{iklan}', 'ApiIklanController@showIn');
	// }

	// Route::group(['middleware' => 'jwt.check'], function () {
 //        Route::get('iklan/{iklan}', ['uses' => 'Api\ApiIklanController@show']);
 //    });


	Route::resource('wishlist', 'Api\ApiWishlistController', [
		'except' => ['create', 'edit', 'show', 'update']
	]);

	Route::delete('wishlist/{iklan}/delete', 'Api\ApiWishlistController@delete');

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

	Route::get('/user/logout', [
		'uses' => 'Api\AuthController@logout'
	]);

	Route::post('/user/recover', [
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
