<?php

use App\Models\Order;
use App\Models\Product;
use App\Events\CreateOrderEvent;
use Illuminate\Support\Facades\Route;
use Elsayednofal\BackendLanguages\Models\Languages;

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
Route::get('change_lang', function() {
    $language = Languages::where('id', '!=', session('lang_id'))->first();
    session()->put('lang_id', $language->id);
    session()->put('language', $language);
    app()->setlocale($language->symbole);
    return redirect()->back();
});
Route::group(['namespace' => '\App\Http\Controllers\front', 'middleware' => ['frontlanguage']], function() {
    Route::get('get-active', function () {
        $lang_id = session()->has('language') ? session('language')->id : 1;
        return response()->json(['status' => true, 'data' => $lang_id]);
    });
    Route::any('/payment/success/{id}', 'PaymentController@success');
    Route::any('/payment/cancel', 'PaymentController@fail');
    Route::get('/payment/{id}', 'PaymentController@index');
    Route::get('/product/{product}', function(Product $product) {
        return view('front.pages.product')->with('product_id', $product->id);
    });
    Route::get('/category/{id?}', "CategoryController@index");
    Route::get('/products/{id?}', "CategoryController@products");
    Route::get('/search/{name?}', "CategoryController@search");
    Route::view('/', 'front.pages.home');
    Route::view('/privacy', 'front.pages.privacy');
    Route::view('/about_us', 'front.pages.about');
    Route::view('/contact-us', 'front.pages.contact-us');
    Route::view('cart', 'front.pages.cart');


    Route::post('/contact', 'HomeController@index');
    Route::post('/subscribe', 'HomeController@subscribe');
    Route::post('/subscribe', 'HomeController@Subscribe');
    Route::any('/forget', 'AuthController@forgetPassword');
    Route::any('/reset/{name}', 'AuthController@resetPassword');
    Route::get('/login', 'AuthController@login');
    Route::post('/login', 'AuthController@postLogin')->name('login');
    Route::post('/logout', 'AuthController@logout')->name('logout');
    Route::get('/check-login', 'AuthController@checklogin')->name('check-login');
    Route::get('/register', 'AuthController@register');
    Route::post('/register', 'AuthController@postRegister');
    Route::get('/category/{id}', "CategoryController@index");
    Route::group(['middleware' => ['auth']], function () {
        Route::get('myaccount', 'UsersController@myaccount');
        Route::get('order-details/{id}', 'UsersController@myOrder');
        Route::post('myaccount/update', 'UsersController@updateProfile');
        Route::post('addresses/update', 'UsersController@saveAddress');
        Route::view('order-summary', 'front.pages.order-summary');
        Route::view('wishlist', 'front.pages.wishlist');
        Route::get('logout', function () {
            auth()->logout();
            return redirect('/');
        });
    });
});


// Route::view('/test','test');

// Route::get('/', function () {
//     $order=Order::first();
//     event(new CreateOrderEvent($order,$order->items));
//     return view('welcome');
// });

