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

Route::get('/users', function (Request $request){
	return response()->json(\App\User::all());
})->middleware('auth:api');

// Create user.
Route::post('/users/create',['uses' => 'RegistrationController@store']);

// Verify if user has confirmed email.
Route::get('/verify/{id}/{token}', ['uses' => 'VerifyEmailController@verify']);

// Forgotten password
Route::post('/forgot-password', 'ForgotPasswordController@forgotPassword');
Route::post('/forgot-password-check', 'ForgotPasswordController@checkUser');

// UserInfo
Route::post('/userInfo', 'UserInfoController@postInfo');
Route::put('/userInfo/edit', 'UserInfoController@editInfo');

// Photography types

// Posts
Route::post('/post', 'PostController@postPost');
Route::get('/posts', 'PostController@getPosts');

// Comments
Route::post('/post/{postId}/postComment', 'CommentsController@postComment');
Route::get('/post/{postId}/getComments', 'CommentsController@getComments');

//
Route::post('/quote', ['uses' => 'QuoteController@postQuote']);
Route::get('/quotes', ['uses' => 'QuoteController@getQuotes']);
Route::put('/quote/{id}', ['uses' => 'QuoteController@putQuote']);
Route::delete('/quote/{id}', ['uses' => 'QuoteController@deleteQuote']);