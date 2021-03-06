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
Route::get('about', 'PagesController@about');
Route::get('category/{slug}', 'PagesController@category');
Route::get('product/{slug}', 'PagesController@product');

Route::post('contact', 'PagesController@contact');

Route::get('cart', 'CartController@showCart');
Route::get('checkout', 'PagesController@showCheckout');
Route::post('checkout', 'CheckoutController@checkout');

Route::get('cart/countitems', 'CartController@getItemCount');
Route::delete('cart/{rowId}', 'CartController@removeItem');
Route::post('cart/additem', 'CartController@add');
Route::post('cart/update/{rowId}', 'CartController@updateRow');
Route::get('cart/remove/{itemId}', 'CartController@remove');

Route::post('uploads/logos', 'LogoUploadsController@store');



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

        Route::get('orders', 'OrdersController@index');
        Route::get('orders/archives', 'OrdersController@indexArchived');
        Route::get('orders/{id}', 'OrdersController@show');
        Route::get('orders/archives/{id}', 'OrdersController@archive');
        Route::delete('orders/{id}', 'OrdersController@delete');

        Route::get('announcements', 'AnnouncementsController@index');
        Route::get('announcements/create', 'AnnouncementsController@create');
        Route::get('announcements/{id}/edit', 'AnnouncementsController@edit');
        Route::post('announcements', 'AnnouncementsController@store');
        Route::post('announcements/{id}', 'AnnouncementsController@update');
        Route::delete('announcements/{id}', 'AnnouncementsController@delete');

        Route::get('api/products/{productId}/sizes', 'ProductApiController@getProductSizes');
        Route::post('api/products/{id}/sizes', 'ProductApiController@syncProductSizes');
        Route::get('api/products/allproducts', 'ProductApiController@listProducts');
        Route::post('api/products/promote/{id}', 'ProductApiController@setPromote');
        Route::get('api/products/{searchTerm}', 'ProductApiController@search');

    });

    Route::group(['middleware' => 'guest'], function() {
        Route::get('login', 'AuthController@showLogin');
        Route::post('login', 'AuthController@doLogin');
    });

});


