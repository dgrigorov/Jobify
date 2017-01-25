<?php

Route::get('/', 'JobController@index');

Route::post('jobs/search', 'JobController@search');

Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard')->middleware('dashboard.redirect');
    Route::get('jobs/{job}', 'JobController@show');
    Route::get('download/{applicationId}/{fileName}', 'DownloadController@applicationFile');
});

Route::group(['middleware' => ['auth', 'role:' . \App\AccountRoles::User]], function () {
    Route::post('jobs/{job}/apply', 'JobController@apply');
});

Route::group(['middleware' => ['auth', 'role:' . \App\AccountRoles::Company]], function () {
    Route::post('jobs', 'JobController@create');
});

Route::group(['middleware' => ['auth', 'role:' . \App\AccountRoles::Administrator]], function () {
    Route::post('jobs/categories', 'JobController@createCategory');
    Route::post('jobs/{job}', 'JobController@edit');
    Route::post('jobs/{job}/publish', 'JobController@publish');
    Route::post('jobs/{job}/delete', 'JobController@delete');
});

// Authentication Routes
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes
Route::get('register/user', 'Auth\RegisterUserController@showRegistrationForm')->name('register');
Route::post('register/user', 'Auth\RegisterUserController@register');
Route::get('register/company', 'Auth\RegisterCompanyController@showRegistrationForm')->name('register');
Route::post('register/company', 'Auth\RegisterCompanyController@register');

// Password Reset Routes
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

