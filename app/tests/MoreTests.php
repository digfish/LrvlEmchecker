<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MoreTests
 *
 * @author sam
 */
class MoreTests extends TestCase {

    public function testNextWithdrawalLast() {
        $last = Next_withdrawal::last();
        $queries = DB::getQueryLog();
        var_dump($queries);
        var_dump($last);
        $this->assertTrue(!empty($last));
    }

}

?>
