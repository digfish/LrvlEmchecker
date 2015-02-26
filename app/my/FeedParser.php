<?php


/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SimplePieLoader
 *
 * @author sam
 */
class FeedParser {

    var $simplepie;

    function __construct() {
        $this->simplepie = new SimplePie();
        //$this->simplepie->enable_cache(FALSE);
        $this->simplepie->set_cache_duration(3600);
        //$this->simplepie->set_timeout(0);
    }

    function set_feed_url($url) {
        $this->simplepie->set_feed_url($url);
    }

    function set_cache_location($location) {
        $this->simplepie->set_cache_location($location);
    }

    function get_simplepie() {
        return $this->simplepie;
    }

    function fetch() {

        //echo __METHOD__;
        //$this->simplepie->set_useragent('Mozilla/5.0 (Macintosh; Intel Mac OS X 10_6_8) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.116 Safari/537.36');
        $this->simplepie->handle_content_type();
        $this->simplepie->set_input_encoding('ISO-8859-1');
        // echo '2'.__METHOD__;
        //$raw_data_xml = file_get_contents($this->simplepie->feed_url);


        try {
            $this->simplepie->init();
        } catch (Exception $ex) {
            Log::error('debug', $ex->getMessage());
        }


        //echo $this->simplepie->raw_data;

        return $this->simplepie->get_items();
    }

}

?>
