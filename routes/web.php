<?php


//User Route

Route::group(['namespace' => 'User'],function(){

	Route::get('/','HomeController@index')->name('user.home');

	Route::get('post/{post}','PostController@post')->name('post');

	Route::get('post/tag/{tag}','HomeController@tag')->name('tag');

	Route::get('post/category/{category}','HomeController@category')->name('category');

});






//Admin Route

Route::group(['namespace' => 'Admin'],function(){

	Route::get('admin/home','HomeController@index')->name('admin.home');
	// User Routes
	Route::resource('admin/user','UserController');
	// Post Routes
	Route::resource('admin/post','PostController');
	// Role Routes
	Route::resource('admin/role','RoleController');
	// Permission Routes
	Route::resource('admin/permission','PermissionController');
	// Tag Routes
	Route::resource('admin/tag','TagController');
	// Category Routes
	Route::resource('admin/category','CategoryController');

	//Admin Auth Routes
	Route::get('admin-login', 'Auth\LoginController@showLoginForm')->name('admin.login');

	//Admin login post
	Route::post('admin-login', 'Auth\LoginController@login');

	Route::get('/logout','Auth\LoginController@logout')->name('logout');

});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/about', 'HomeController@about')->name('about');

Route::get('/contact', 'HomeController@contact')->name('contact');