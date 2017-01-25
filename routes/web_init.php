<?php

Route::get('register/administrator', 'Auth\RegisterAdministratorController@showRegistrationForm')->name('register');
Route::post('register/administrator', 'Auth\RegisterAdministratorController@register');