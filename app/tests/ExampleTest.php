<?php


class ExampleTest extends TestCase {

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample() {
        $crawler = $this->client->request('GET', '/');

        $this->assertTrue($this->client->getResponse()->isOk());
    }

    public function testListShots() {
        $all_shots = Shot::all();

        $this->assertTrue(count($all_shots) > 0);

        //var_dump($all_shots);
    }

    public function testListWithdrawals() {
        $all_withdrawals = Withdrawal::all();

        $this->assertTrue(count($all_withdrawals) > 0);

        //var_dump($all_withdrawals);
    }

    public function testInvokeSimplepie() {
        App::bind('simplepie', function($app) {
                    return new SimplePie;
          });
        
        $simplepie =  App::make('simplepie');
        
        //var_dump($simplepie);
        
        $this->assertTrue($simplepie instanceof SimplePie);
    }
    
    public function testInvokeMyFeedParser() {
        $simplepie = App::make('myfeedparser');
        //var_dump($simplepie);
        
        $this->assertTrue($simplepie instanceof FeedParser);        
        
    }
    
    public function testFeedParserFetch() {
        $feed_parser = App::make('myfeedparser');
        $feed_parser->set_feed_url('https://www.jogossantacasa.pt/web/SCRss/rssFeedJackpots');
        $items = $feed_parser->fetch();
        
        //var_dump($items);
        
        $this->assertTrue( ! empty($items) );
    }
    
    public function testNextWithdrawalGetBySerialNumber() {
        $next_withdrawal = Next_withdrawal::get_by_serial_number('071/2013');
//          $queries = DB::getQueryLog();
//         var_dump($queries);
//        var_dump($next_withdrawal);
        $this->assertTrue ( $next_withdrawal->count() > 0);
    }
    
   

}