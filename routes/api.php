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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['namespace' => 'App\Http\Controllers\apis'], function () {
    Route::get('upload-tags','HomePageApi@upload');
    //======================= selectors ========================= 
    Route::get('languages', 'SelectsController@getLanguages');
    Route::get('languages/get-active', 'SelectsController@getActiveLang');

  
    //============================= Auth =============================
    Route::post('auth/signup', 'AuthApi@register');
    Route::post('auth/signin', 'AuthApi@login');
    Route::post('auth/login-social', 'AuthApi@loginSocial');
    Route::post('contact','HomePageApi@contact');
    Route::get('setting','HomePageApi@setting');

    Route::group(['middleware' => ['language']], function () {
    Route::get('about','HomePageApi@about');
        Route::get('cities', 'SelectsController@getCities');
        Route::get('tags', 'HomePageApi@tags');
        Route::get('home-page', 'HomePageApi@index');
        Route::get('main-categories','CategoriesApi@index');
        Route::get('sub-categories','CategoriesApi@sub');
        Route::get('categories/show','CategoriesApi@show');
        Route::get('categories/get','CategoriesApi@getCategory');
        Route::get('products','ProductsApi@index');
        Route::get('products/show','ProductsApi@show');
        Route::post('carts/add','CartsApi@add');
        Route::get('carts','CartsApi@index');
        Route::any('carts/index','CartsApi@index');
        Route::get('carts/delete','CartsApi@delete');
        Route::post('promo/check','CartsApi@checkPromo');
        Route::post('carts/edit-number','CartsApi@edit');
        Route::group(['middleware' => ['auth:api']], function () {
            Route::get('users/myaccount','UsersAPI@myacount');
            Route::post('users/update-profile','UsersAPI@updateProfile');
            Route::get('users/update-device-id','UsersAPI@updateDeviceId');
            Route::post('users/update-password','UsersAPI@updatePassword');
            Route::get('profile/logout', 'UsersAPI@logout');
            Route::get('checkout_cost','OrdersApi@cost');
            Route::post('checkout','OrdersApi@index');
            Route::get('orders','UsersAPI@orders');
            Route::get('orders/show','UsersAPI@showOrder');
          
            //============================Rating=======================
            Route::post('rating/add','RatingAPI@add');
            // ============== addresses =================
            Route::get('address/get','UsersAPI@getAdreesses');
            Route::post('address/add','UsersAPI@addAdreess');
            Route::post('address/update','UsersAPI@updateAdrress');
            Route::post('address/delete','UsersAPI@deleteAdrress');
            // ============== addresses =================
            Route::get('wishlists','WishlistApi@index');
            Route::get('wishlists/add','WishlistApi@add');
            Route::get('wishlists/delete','WishlistApi@delete');

            //============= assign to user ===================
            Route::get('cart/assign-to-user','CartsApi@assignToUser');

          
        });
    });
    
});
