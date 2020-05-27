<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::post('/login', 'AuthController@login');

Route::middleware('auth:api')->group(function(){


/*
    Login
*/
/*
    Clients
*/
Route::get('/clients', "ClientController@getClients");
Route::get('/client/{id}', "ClientController@getSingleClient");
Route::get('/search/clients/{search}', 'ClientController@getClientSearch');
Route::post('/addClient', 'ClientController@addClient');
Route::post('/updateClient/{id}', 'ClientController@updateClient');


/*
    Client types
*/
Route::get('/client_types', "ClientTypeController@getClientTypes");
Route::get('/client_type/{id}', 'ClientTypeController@getSingleClientType');

/*
    Locations
*/
Route::get('/locations', "LocationController@getLocations");
Route::get('/location/{id}', "LocationController@getSingleLocation");
Route::get('/search/locations/{search}', 'LocationController@getLocationSearch');
Route::post('/addLocation', 'LocationController@addLocation');

/*
    Offers
*/
Route::get('/offers', "OfferController@getOffers");
Route::get('/offer/{id}', "OfferController@getSingleOffer");
Route::post('/addOffer', 'OfferController@addOffer');

/*
    Orders
*/

Route::get('/orders', "ClientController@getOrders");
Route::get('/order/{id}', "OrderController@getSingleOrder");
Route::get('/search/orders/{search}', 'OrderController@getOrderSearch');
Route::post('/addOrder', 'OrderController@addOrder');

/*
    PaymentMethod
*/
Route::get('/paymentMethods', 'PaymentMethodController@getMethods');
Route::get('/paymentMethod/{method}', 'PaymentMethodController@getSingleMethod');
Route::post('/addPaymentMethod', 'PaymentMethodController@addPaymentMethod');

/* 
    Products
*/
Route::get('/products', 'ProductController@getProducts');
Route::get('/product/{id}', 'ProductController@getSingleProduct');
Route::post('/addProduct', 'ProductController@addProduct');
/*
    Providers
*/
Route::get('/providers', 'ProviderController@getProviders');
Route::get('/provider/{id}', 'ProviderController@getSingleProvider');
Route::post('/addProvider', 'ProviderController@addProvider');

/*
    Sellers
*/
Route::get('/sellers', 'SellerController@getSellers');
Route::get('/getSellers', 'SellerController@getSingleSeller');
Route::post('/addSeller', 'SellerController@addSeller');

});