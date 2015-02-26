<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



/**
 * Description of Shot
 *
 * @author viana
 */
class Withdrawal extends Eloquent {
    //put your code here
    
    var $timestamps = FALSE;

    static function get_by_serial_number($serial_number) {

        return self::where('nr', '=', $serial_number)->get();
    }


    static function last() {
		return DB::table('withdrawals')->orderBy('id', 'desc')->first();
	}

}
