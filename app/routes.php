<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	$data = array();
	if(Sentry::check()) {
		$sentry = Sentry::getUser();
		$data = User::find($sentry->id);
	}
	return View::make('hello', array('data' => $data));
});

Route::get('login/fb', 'LoginFacebookController@login');
Route::get('login/fb/callback', 'LoginFacebookController@callback');
Route::get('logout', function()
{
	Sentry::logout();
	return Redirect::to('/');
});
