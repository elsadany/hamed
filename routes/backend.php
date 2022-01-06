<?php

Route::get('backend', function() {
    return redirect('backend/backend-users');
});
Route::get('brands/get/{id}','\App\Http\Controllers\backend\BrandsController@getBrands');
Route::group(['prefix' => 'backend', 'namespace' => '\App\Http\Controllers\backend', 'middleware' => ['auth:admin']], function() {
    //users
    Route::post('users/delete/{user}', 'UsersController@delete');
    Route::any('users/edit/{user}', 'UsersController@edit');
    Route::any('users/create', 'UsersController@create');
    Route::get('users', 'UsersController@index');
    //home Page
    Route::any('statitcs','StaticsController@index');
    Route::any('home-page','HomePageController@index')->name('home-page.index');
    Route::any('/ajax/upload','HomePageController@anyUpload');
    Route::any('home-page/store','HomePageController@store');
    // categories
    Route::any('categories/create','CategoriesController@create');
    Route::any('categories/edit/{category}','CategoriesController@edit');
    Route::any('categories/delete/{category}','CategoriesController@delete');
    Route::any('categories','CategoriesController@index');
    // brands
    Route::any('brands/create','BrandsController@create')->name('brands.create');
    Route::any('brands/edit/{brand}','BrandsController@edit')->name('brands.update');
    Route::any('brands/delete','BrandsController@delete')->name('brands.delete');
    Route::any('brands','BrandsController@index');
    // products
    Route::get('products/create','ProductsController@create')->name('products.create');
    Route::get('products/edit/{product}','ProductsController@edit')->name('products.edit');
    Route::post('products/delete/{product}','ProductsController@delete')->name('products.delete');
    Route::get('products','ProductsController@index');
//Promocodes
    Route::get('promocodes', 'PromoCodesController@index')->name('promocodes.index');
    Route::any('promocodes/create', 'PromoCodesController@create')->name('promocodes.create');
    Route::any('promocodes/update/{promocode}', 'PromoCodesController@update')->name('promocodes.update');
    Route::post('promocodes/delete/{promocode}', 'PromoCodesController@delete')->name('promocodes.delete');

    // products api
    Route::get('get-languages','ProductsController@getLanguages');
    Route::get('get-categories','ProductsController@getCategories');
    Route::get('get-brands','ProductsController@getBrands');
    Route::post('products/save-product','ProductsController@saveProduct');
    Route::post('products/save-option','ProductsController@saveOption');
    Route::get('products/get-product/{product}','ProductsController@getProduct');
    Route::post('products/delete-option','ProductsController@deleteOption');
    Route::get('products/get-options/{product}','ProductsController@getOptions');
    Route::get('products/get-category-options/{category}','ProductsController@getCategoryOptions');
    Route::post('products/upload-images','ProductsController@uploadImages');
    Route::get('products','ProductsController@index');
    Route::get('get-tags','ProductsController@getTags');
    //General Tags
    Route::get('general_tags', 'GeneralTagsController@index')->name('general_tags.index');
    Route::any('general_tags/create', 'GeneralTagsController@create')->name('general_tags.create');
    Route::any('general_tags/update/{general_tag}', 'GeneralTagsController@update')->name('general_tags.update');
    Route::post('general_tags/delete/{general_tag}', 'GeneralTagsController@delete')->name('general_tags.delete');
    //Static Pages
    Route::get('static_pages', 'StaticPagesController@index')->name('static_pages.index');
    Route::any('static_pages/create', 'StaticPagesController@create')->name('static_pages.create');
    Route::any('static_pages/update/{static_page}', 'StaticPagesController@update')->name('static_pages.update');
    Route::post('static_pages/delete/{static_page}', 'StaticPagesController@delete')->name('static_pages.delete');

    // options
    Route::any('options/create/{category?}','OptionsController@create');
    Route::any('options/edit/{category}/{option}','OptionsController@edit');
    Route::any('options/delete/{option}','OptionsController@delete');
    Route::any('options/{category?}','OptionsController@index');
  //Cities
    Route::get('cities', 'CitiesController@index')->name('cities.index');
    Route::any('cities/create', 'CitiesController@create')->name('cities.create');
    Route::any('cities/update/{city}', 'CitiesController@update')->name('cities.update');
    Route::post('cities/delete/{city}', 'CitiesController@delete')->name('cities.delete');
//Users
      Route::get('users', 'UserController@index')->name('users.index');
      Route::get('orders', 'OrdersController@index')->name('orders.index');
      Route::get('orders/update-status/{id}', 'OrdersController@updateStatus')->name('orders.updateStatus');

});


$status=[
    0=>'تم الطلب',
    1=>'تم الشحن',
    2=>'تم التسليم',
    3=>'تم الألغاء'
];
$en_status=[
    0=>'Ordered',
    1=>'Shipped',
    2=>'Delivered',
    3=>'Canceled'
];
define('status',$status);
define('en_status',$en_status);
$types=[
    1=>'select',
    2=>'Checkbox',
    3=>'Color',
    4=>'text',
    5=>'Radio'
];
define('types',$types);
