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

Route::get('/', 'HomeController@showHome');

Route::get('/logout', 'HomeController@logout');

/*
 * Geekie will issue a redirect to this endpoint.
 */
Route::get('/oauth2callback', 'OAuth2Controller@getAuthorizationCode');
