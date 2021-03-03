<?php

Route::group(['namespace' => 'Dorcas\ModulesAuth\Http\Controllers', 'prefix' => 'auth'], function() {
	Route::get('/', 'ModulesAuthController@business')->name('dashboard');
	Route::get('/setup', 'ModulesAuthController@welcome_setup')->name('welcome-setup');
	Route::post('/setup', 'ModulesAuthController@welcome_post');
	Route::get('/overview', 'ModulesAuthController@welcome_overview')->name('welcome-overview');
	Route::post('/resend-verification', 'ModulesAuthController@resendVerification');
});

?>