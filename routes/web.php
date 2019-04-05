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

Route::get('/','MyHomeController@index')->name('myhome');



Route::get('/myhome','MyHomeController@index')->name('myhome');

Route::post('/postMessage','ChatController@sendMessage')->name('postMessage');

Route::post('/getMessages','ChatController@getMessages')->name('getMessages');

Route::post('/getMessages2','ChatController@getMessages2')->name('getMessages2');

Route::get('/tests','ChatController@test');

Route::get('/myprofile','ProfilePageController@myProfile')->name('myProfile');

Route::post('/makePost','PostsController@createPost')->name('makePost');

Route::get('/getUserPosts','PostsController@getUserPosts')->name('getPosts');

Route::post('/perditesoRrethMeje','AboutMeController@updateAboutMe')->name('perditesoRrethMeje');

Route::get('/merrRrethMeje','AboutMeController@getAboutMe')->name('merrRrethMeje');

Route::get('/friendRequests','FriendRequestController@frienRequestsPage')->name('friendRequests');

Route::post('/sendFriendRequest','FriendRequestController@sendFriendRequest')->name('sendFriendRequest');

Route::post('/acceptFriendRequest','FriendRequestController@acceptRequest')->name('acceptFriendRequest');

Route::post('/searchByName','SearchController@searchByName')->name('searchByName');

Route::get('/serverError','ServerErrorController@serverError')->name('serverError');

Route::post('/uploadUserImages','ImageController@uploadImages')->name('uploadUserImages');

Route::get('/getuserimages','ImageController@getUserImages')->name('getUserImages');

Route::get('/getAllPosts','PostsController@getAllPosts')->name('getAllPosts');

Route::get('/getUserPosts','PostsController@getUserPosts')->name('getUserPosts');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/registration','RegistrationController@index')->name('registration');

Route::post('/createUser','RegistrationController@create');
