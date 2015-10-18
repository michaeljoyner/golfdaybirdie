<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'PagesController@home');
Route::get('cart', 'CartController@showCart');
Route::get('about', 'PagesController@about');
Route::get('category/{slug}', 'PagesController@category');
Route::get('product/{slug}', 'PagesController@product');

Route::post('contactus', 'PagesController@contact');

Route::get('checkout', 'PagesController@showCheckout');
Route::post('checkout', 'PagesController@handleCheckout');

Route::get('cart/contents/{timestamp}', 'CartController@getContents');
Route::get('cart/destroy', 'CartController@destroy');
Route::get('cart/countitems', 'CartController@getItemCount');
Route::delete('cart/{rowId}', 'CartController@removeItem');
Route::post('cart/additem', 'CartController@add');
Route::get('cart/remove/{itemId}', 'CartController@remove');

Route::post('logouploads', 'LogoUploadController@storeLogo');


Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {

    Route::group(['middleware' => 'auth'], function() {
        Route::get('/', 'PagesController@dashboard');

        Route::get('logout', 'AuthController@doLogout');

        Route::post('uploads/productimg', 'AjaxImageUploadsController@storeProductImage');
        Route::post('uploads/categoryimg', 'AjaxImageUploadsController@storeCategoryImage');
        Route::post('uploads/versionimg', 'AjaxImageUploadsController@storeVersionImage');

        Route::get('users', 'UsersController@index');
        Route::get('resetpassword', 'UsersController@showResetPassword');
        Route::post('resetpassword', 'UsersController@doResetPassword');
        Route::get('register', 'UsersController@showRegister');
        Route::post('users/register', 'UsersController@postRegistration');
        Route::get('users/{id}/edit', 'UsersController@edit');
        Route::post('users/{id}/edit', 'UsersController@update');
        Route::delete('users/{id}', 'UsersController@delete');

        Route::get('categories', 'CategoriesController@index');
        Route::get('categories/create', 'CategoriesController@create');
        Route::post('categories', 'CategoriesController@store');
        Route::get('categories/{id}/edit', 'CategoriesController@edit');
        Route::get('categories/{id}', 'CategoriesController@show');
        Route::post('categories/{id}', 'CategoriesController@update');
        Route::delete('categories/{id}', 'CategoriesController@delete');
        Route::get('categories/{id}/addproduct', 'ProductsController@create');
        Route::post('categories/{categoryId}/products', 'ProductsController@store');


        Route::get('products', 'ProductsController@index');
        Route::get('products/{id}', 'ProductsController@show');
        Route::get('products/{id}/edit', 'ProductsController@edit');
        Route::post('products/{id}', 'ProductsController@update');
        Route::delete('products/{id}', 'ProductsController@delete');

        Route::get('products/{productId}/versions/create', 'ProductVersionsController@create');
        Route::post('products/{productId}/versions', 'ProductVersionsController@store');

        Route::get('versions/{id}/edit', 'ProductVersionsController@edit');
        Route::post('versions/{id}', 'ProductVersionsController@update');
        Route::delete('versions/{id}', 'ProductVersionsController@delete');

        Route::get('quoterequests', 'QuoteRequestsController@index');
        Route::get('quoterequests/archives', 'QuoteRequestsController@archivesIndex');
        Route::get('quoterequests/archive/{id}', 'QuoteRequestsController@archive');
        Route::get('quoterequests/{id}', 'QuoteRequestsController@show');
        Route::delete('quoterequests/{id}', 'QuoteRequestsController@delete');

        Route::get('api/products/{productId}/sizes', 'ProductApiController@getProductSizes');
        Route::post('api/products/{id}/sizes', 'ProductApiController@syncProductSizes');
        Route::get('api/products/allproducts', 'ProductApiController@listProducts');
        Route::get('api/products/{searchTerm}', 'ProductApiController@search');

    });

    Route::group(['middleware' => 'guest'], function() {
        Route::get('login', 'AuthController@showLogin');
        Route::post('login', 'AuthController@doLogin');
    });

});


