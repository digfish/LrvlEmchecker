<?php

#require "FeedParser.php";

use FastFeed\Factory;

class FastFeedInvoker implements FeedParser {

    var $fetcher;

    function __construct() {
        $this->fetcher = Factory::create();

    }

    public function set_feed_url($url) {
        $this->fetcher->addFeed('default',$url);
    }

    public function fetch() {

        //echo __METHOD__;
        //$this->simplepie->set_useragent('Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.116 Safari/537.36');
        // echo '2'.__METHOD__;
        //$raw_data_xml = file_get_contents($this->simplepie->feed_url);

        $items = NULL;
        try {
            $items = $this->fetcher->fetch('default');
        } catch (Exception $ex) {
            Log::error($ex->getMessage(),array('context' => $ex));
        }


        //echo $this->simplepie->raw_data;

        return $items;
    }

}

?>
