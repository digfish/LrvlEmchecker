<?php


class HomeController extends BaseController {
    /*
      |--------------------------------------------------------------------------
      | Default Home Controller
      |--------------------------------------------------------------------------
      |
      | You may wish to use controllers instead of, or in addition to, Closure
      | based routes. That's great! Here is an example controller method to
      | get you started. To route to this controller, just add the route:
      |
      |	Route::get('/', 'HomeController@showWelcome');
      |
     */

    public function showWelcome() {
        return View::make('hello');
    }

    public function getIndexShots() {
            $shots = Shot::orderBy('registered_at','desc')->paginate(10);
           // Log::debug('shots',array($shots));
            return View::make('indexShots')->with('shots', $shots);
    }

    public function getIndexWithdrawals() {
            $withdrawals = Withdrawal::all();
            // Log::debug(withdrawals, array($withdrawals));
            return View::make('indexWithdrawals')->with('withdrawals', $withdrawals);
    }

    public function getRegisterShotForm() {
            $next_withdrawal = Next_withdrawal::last();
            return View::make('showRegisterForm')->with('next_withdrawal',$next_withdrawal);
        }

    public  function postRegisterShotForm() {
            $new_shot = new Shot();

            $new_shot->shot = Input::get('shot_numbers') . ' + ' . Input::get('shot_stars');
            $new_shot->registered_at = date('Y-m-d H:i:s');
            $new_shot->nr = Input::get('withdrawal_id');

            $new_shot->save();

            return Redirect::to('/')->with('message', "Your key {$new_shot->shot}"
                            . " were successfully registered for the withdrawal {$new_shot->nr}");
    }

    public function next_withdrawal() {

        $feed_parser = App::make('myfeedparser');
        $feed_parser->set_feed_url('https://www.jogossantacasa.pt/web/SCRss/rssFeedJackpots');
        $items = $feed_parser->fetch();

        //var_dump($items);

        foreach ($items as $item) {
            //echo "HELLO!!!";
            $title = $item->getName();

            Log::debug($title);

            if (trim($title) == 'Euromilhões') {

                $description = $item->getContent();
                preg_match('/&euro;(.+?)<br>/', $description, $matches);

                $next_prize_value = $matches[1];

                preg_match('/((\d){2}\/(\d){2}\/(\d){4})/', $description, $matches);

                $scheduled_to = $matches[0];

                preg_match('/((\d){3}\/(\d){4})/', $description, $matches);

                $next_withdrawal_id = $matches[0];

                $next_withdrawal_already_fetched = Next_withdrawal::get_by_serial_number($next_withdrawal_id);



                $message = '';

                if ($next_withdrawal_already_fetched->count() == 0) {

                    $new_row = new Next_withdrawal();

                    $new_row->nr = $next_withdrawal_id;
                    $new_row->scheduled_to = $scheduled_to;
                    $new_row->prize_value = $next_prize_value;
                    $new_row->created_at = date('Y-m-d H:i:s');

                    $new_row->save();

                    var_dump($new_row);
                } else {
                   // $message = 'The next withdrawal were already fetched at ' . $next_withdrawal_already_fetched->first()->created_at . "<BR/>";
                }

                $next_withdrawal = Next_withdrawal::last();

				$message .= "The next withrawal will be the {$next_withdrawal->nr}, at {$next_withdrawal->scheduled_to}, ".
				"with the prize of {$next_withdrawal->prize_value} &euro; <BR/>";

                return Redirect::to('/')->with('message', $message);
            }
        }
    }

        public function last_withdrawal() {

        $feed_parser = App::make('myfeedparser');
        $feed_parser->set_feed_url('https://www.jogossantacasa.pt/web/SCRss/rssFeedCartRes');
        $items = $feed_parser->fetch();


/*        print "<PRE>";
       dd($items);*/

        foreach ($items as $item) {
            $title = $item->getName();
            //echo "$title\n";
            if (trim($title) == 'Euromilhões') {
                $description = strip_tags($item->getContent());
                $tokens = explode(':', $description);
                preg_match("/([0-9]{3}\/[0-9]{4})/", $tokens[0], $matches);
                $serial_number = $matches[1];
                $key = trim($tokens[1]);
                $date = $item->getDate()->format('Y-m-d H:i:s');
                //$time = strtotime($date);
                //$datetime = date('Y-m-d H:i:s', $time);

                $withdrawal_already_fetched = Withdrawal::get_by_serial_number( $serial_number);

                if ($withdrawal_already_fetched->count() == 0 && !empty($serial_number)) {
                    Log::debug("Last withdrawal fetched!");
                    $new_withdrawal = new Withdrawal();
                    $new_withdrawal->nr = $serial_number;
                    $new_withdrawal->key = $key;
                    $new_withdrawal->created_at = $date;
                    $new_withdrawal->save();
                } else {
                    echo "This withdrawal ($serial_number) were already fetched!" . PHP_EOL;
                }
            }
        }



        $last_withdrawal = Withdrawal::last();

        if (!empty($last_withdrawal)) {
	        $message = "The last withrawal were {$last_withdrawal->nr}, with the key <B>{$last_withdrawal->key}</B>"
    	    .", done at {$last_withdrawal->created_at}";}
        else {
        	$message = "There were some error retrieving the last withdrawal";
        }

        //var_dump($message);

        //var_dump($last_withdrawal);

         //return Redirect::to('/')->with('message', $message);

        return $message;

    }


    public function fetch_and_compare() {
        $output = App::make(__CLASS__)->last_withdrawal();
        $output .= "<BR>" . App::make(__CLASS__)->compare();
        if (! App::runningInConsole() ) {
            return Redirect::to('/')->with('message', $output);
        }
//       $this->last_withdrawal();
//        $this->compare();
    }

    public function compare() {

        ob_start();

        $last_withdrawal = Withdrawal::last();

        if ($last_withdrawal != NULL) {

            echo ("The last withdrawal at " . $last_withdrawal->created_at . " were " . $last_withdrawal->key);
            echo PHP_EOL;
            $last_key = Shot::last();
            echo ("Your last shot: " . $last_key->shot );
            echo PHP_EOL;
            $last_withdrawal_tokens = explode('+', $last_withdrawal->key);
            $last_key_tokens = explode('+', $last_key->shot);

            $last_withdrawal_numbers = explode(' ', trim($last_withdrawal_tokens[0]));
            $last_key_numbers = explode(' ', trim($last_key_tokens[0]));

            $common_numbers = array_intersect($last_withdrawal_numbers, $last_key_numbers);

            $last_withdrawal_stars = explode(' ', trim($last_withdrawal_tokens[1]));
            $last_key_stars = explode(' ', trim($last_key_tokens[1]));

            $common_stars = array_intersect($last_withdrawal_stars, $last_key_stars);

            echo PHP_EOL;
            echo PHP_EOL;


            if (count($common_numbers) > 0) {
                echo "You had hit " . count($common_numbers) . " number(s) : " . join(' ', $common_numbers);
            } else {
                echo "You had not hit any number!";
            }

            echo PHP_EOL;

            if (count($common_stars) > 0) {
                echo "You had hit " . count($common_stars) . " star(s) : " . join(' ', $common_stars);
            } else {
                echo "You had not hit any star!";
            }

            echo PHP_EOL;
        }

       $output = ob_get_clean();

        if ( App::runningInConsole() ) {
            Log::info( "This was invoked from the CLI, sending e-mail...\n");

            $sucess = Mail::send('emails.empty', array('content' => $output), function($message) {
                $message->from('noreply@casa-viana.com', 'Euromillions checker');
                $message->to('pescadordigital@gmail.com');
                $message->subject('Euromillions checker results');
            });



            if ($sucess !== TRUE) {
                Log::info( "Someting wrong happenned when sending the e-mail...");

            } else {
               Log::info( "The e-mail were sent with success!");
            }

            echo PHP_EOL;
        } else {
            return $output;
        }

    }


}