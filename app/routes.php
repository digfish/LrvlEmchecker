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

Route::get('/', function() {
            $shots = Shot::orderBy('registered_at','desc')->get();
            Log::debug('shots',array($shots));
            return View::make('indexShots')->with('shots', $shots);
        });

Route::get('/withdrawals', function() {
            $withdrawals = Withdrawal::all();
            Log::info(__METHOD__, array($withdrawals));
            return View::make('indexWithdrawals')->with('withdrawals', $withdrawals);
        });

Route::get('/register/form', function() {
			$next_withdrawal = Next_withdrawal::last();
            return View::make('showRegisterForm')->with('next_withdrawal',$next_withdrawal);
        });

Route::post('/register/new_shot', function() {
            $new_shot = new Shot();

            $new_shot->shot = Input::get('shot_numbers') . ' + ' . Input::get('shot_stars');
            $new_shot->registered_at = date('Y-m-d H:i:s');
            $new_shot->nr = Input::get('withdrawal_id');

            $new_shot->save();

            return Redirect::to('/')->with('message', "Your key {$new_shot->shot}"
                            . " were successfully registered for the withdrawal {$new_shot->nr}");
        });



Route::get('fetcher/next_withdrawal','HomeController@next_withdrawal');

Route::get('fetcher/fetch','HomeController@last_withdrawal');

Route::get('fetcher/fetch_and_compare','HomeController@fetch_and_compare');

