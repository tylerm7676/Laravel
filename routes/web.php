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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Congrats you got to the Home controller. This loads up resources/views/home.blade.php
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile', 'ProfileController@index')->name('profile');
Route::get('/sponsorlist','SponsorListController@index')->name('sponsorlist');
Route::get('/adminlist','AdminListController@index')->name('adminlist');
Route::get('/createaccount', 'CreateAccountController@index')->name('createaccount');
Route::get('/catalog', 'CatalogController@index')->name('catalog');
Route::get('/FAQ', 'FAQController@index')->name('FAQ');
Route::get('/ebay/search', 'catalogController@search');
Route::get('/driverlistpdf','PDFController@driverlist');
Route::get('/sponsorlistpdf','PDFController@sponsorlist');
Route::get('/adminlistpdf','PDFController@adminlist');

//Lists of Accounts
Route::get('/driverlist', 'DriverListController@index')->name('driverlist');
Route::get('/sponsorlist', 'SponsorListController@index')->name('sponsorlist');
Route::get('/adminlist', 'AdminListController@index')->name('adminlist');

Route::get('/cart', 'CartController@index')->name('cart');
Route::get('/cart/add', 'CartController@add');
Route::get('/catalog/new', 'CatalogController@newItem');
Route::get('/checkout', 'CheckoutController@index')->name('checkout');

//Removing Accounts
Route::get('remove_Admin/{id}', 'AdminListController@remove_Admin')->name('remove_Admin');
Route::get('remove_Sponsor/{user_id}', 'SponsorListController@remove_Sponsor')->name('remove_Sponsor');
Route::get('remove_Driver/{user_id}','DriverListController@remove_Driver')->name('remove_Driver');
Route::get('sponsor_remove_Driver/{id}','DriverListController@sponsor_remove_Driver')->name('sponsor_remove_Driver');

//Editing Accounts
Route::get('/viewdriverprofile/{user_id}', 'ViewDriverProfileController@getDriver')->name('viewdriverprofile');
Route::get('/viewsponsorprofile/{user_id}','ViewSponsorProfileController@getSponsor')->name('viewsponsorprofile');
Route::get('/viewadminprofile/{id}', 'ViewAdminProfileController@getAdmin')->name('viewadminprofile');


Route::get('/orders', 'OrdersController@index')->name('orders');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Profile Updates
Route::get('/update-name', 'ProfileController@changeName');
Route::get('/update-address', 'ProfileController@changeAddress');
Route::post('/create-address', 'ProfileController@createAddress');
Route::get('/update-email', 'ProfileController@changeEmail');
Route::get('/update-orgname', 'Sponsor@changeOrgname');
Route::get('/update-conversion', 'Sponsor@changeConversion');
Route::get('/update-info', 'Sponsor@changeInfo');
Route::get('/update-password', 'ProfileController@changePassword');
Route::get('/update-points','ProfileController@changePoints');

Route::get('/accept-driver', 'ApplicationController@acceptDriver');
Route::get('/reject-driver', 'ApplicationController@regjectDriver');


Route::post('/create_account','CreateAccountController@create_account');

Route::prefix('driver')->group(function () {
    Route::post('new-application', 'ApplicationController@newApplication');
});
