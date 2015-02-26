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
class Shot extends Eloquent {
    //put your code here
    var $timestamps = FALSE;

      static function last() {
		return DB::table('shots')->orderBy('id', 'desc')->first();
	}
}
