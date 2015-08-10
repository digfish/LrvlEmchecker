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

Route::get('/', 'HomeController@getIndexShots');

Route::get('/withdrawals', 'HomeController@getIndexWithdrawals');

Route::get('/register/form','HomeController@getRegisterShotForm');

Route::post('/register/new_shot','HomeController@postRegisterShotForm');

Route::get('fetcher/next_withdrawal','HomeController@next_withdrawal');

Route::get('fetcher/fetch','HomeController@last_withdrawal');

Route::get('fetcher/fetch_and_compare','HomeController@fetch_and_compare');

