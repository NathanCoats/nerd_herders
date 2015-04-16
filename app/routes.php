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

	Route::get('/', array('as' => 'landing', 'uses' => 'DashboardController@index', 'before' => 'auth'));
	Route::get('/home', array('as' => 'dashboard', 'uses' => 'DashboardController@index', 'before' => 'auth'));
	Route::get('/download/{id}',	array('as' => 'download', 'uses' => 'ResourcesController@download'));

	Route::group(
		array('prefix' => 'account','before' => 'auth'),
		function() {
			Route::get('/',	array('as' => 'account', 'uses' => 'AccountController@account'));
			Route::post('/edit',	array('as' => 'account.edit', 'uses' => 'AccountController@editAccount'));

	});

	Route::group(
		array('prefix' => 'resources','before' => 'auth'),
		function() {
			Route::get('/',	array('as' => 'resources', 'uses' => 'ResourcesController@index'));
			Route::get('/new', array('as' => 'resources.new', 'uses' => 'ResourcesController@add'));

			Route::post('/upload',	array('as' => 'resources.upload', 'uses' => 'ResourcesController@upload'));
			Route::post('/delete',	array('as' => 'resources.delete', 'uses' => 'ResourcesController@delete'));
	});

	Route::group(
		array('prefix' => 'message','before' => 'auth'),
		function() {
			Route::get('/inbox',	array('as' => 'message.inbox', 'uses' => 'MessageController@inbox'));
			Route::get('/drafts',	array('as' => 'message.drafts', 'uses' => 'MessageController@drafts'));
			Route::get('/sent',	array('as' => 'message.sent', 'uses' => 'MessageController@sent'));
			Route::get('/compose',	array('as' => 'message.compose', 'uses' => 'MessageController@compose'));

			Route::post('/submit',	array('as' => 'message.submit', 'uses' => 'MessageController@submit'));
			Route::post('/delete',	array('as' => 'message.delete', 'uses' => 'MessageController@delete'));
			Route::post('/save',	array('as' => 'message.edit.submit', 'uses' => 'MessageController@submitEdit'));
			Route::post('/read',	array('as' => 'message.read', 'uses' => 'MessageController@readMe'));
	});

	Route::group(
		array('prefix' => 'news','before' => 'auth'),
		function() {
			Route::get('/',	array('as' => 'news', 'uses' => 'NewsController@index'));
			Route::get('/new',	array('as' => 'news.create', 'uses' => 'NewsController@create'));
			Route::get('/anime', array('as' => 'anime', 'uses' => 'NewsController@anime'));
			Route::get('/group', array('as' => 'group', 'uses' => 'NewsController@group'));
			Route::get('/game',	array('as' => 'game', 'uses' => 'NewsController@game'));
			Route::get('/{id}',	array('as' => 'news.view', 'uses' => 'NewsController@view'));
			Route::get('/edit/{id}',	array('as' => 'news.edit', 'uses' => 'NewsController@edit'));

			Route::post('/submit',	array('as' => 'news.submit', 'uses' => 'NewsController@submit'));
			Route::post('/delete',	array('as' => 'news.delete', 'uses' => 'NewsController@delete'));
			Route::post('/save',	array('as' => 'news.edit.submit', 'uses' => 'NewsController@submitEdit'));
	});

	Route::group(
		array('prefix' => 'howto','before' => 'auth'),
		function() {
			Route::get('/',	array('as' => 'howto', 'uses' => 'HowToController@index'));
			Route::get('/new',	array('as' => 'howto.create', 'uses' => 'HowToController@create'));
			Route::get('/{id}',	array('as' => 'howto.learn', 'uses' => 'HowToController@view'));
			Route::get('/edit/{id}',	array('as' => 'howto.edit', 'uses' => 'HowToController@edit'));

			Route::post('/submit',	array('as' => 'howto.submit', 'uses' => 'HowToController@submit'));
			Route::post('/delete',	array('as' => 'howto.delete', 'uses' => 'HowToController@delete'));
			Route::post('/save',	array('as' => 'howto.edit.submit', 'uses' => 'HowToController@submitEdit'));
	});

// Confide routes
	Route::group(
		array('prefix' => 'users'),
		function() {
				Route::get( 'create',                 'UserController@create');
				Route::post('/',                        'UserController@store');
				Route::get( 'login',                  'UserController@login');
				Route::post('login',                  'UserController@do_login');
				Route::get( 'confirm/{code}',         'UserController@confirm');
				Route::get( 'forgot_password',        'UserController@forgot_password');
				Route::post('forgot_password',        'UserController@do_forgot_password');
				Route::get( 'reset_password/{token}', 'UserController@reset_password');
				Route::post('reset_password',         'UserController@do_reset_password');
				Route::get( 'logout',                 'UserController@logout');
	});
