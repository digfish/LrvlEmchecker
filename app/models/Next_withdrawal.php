<?php

class Next_withdrawal extends Eloquent {

    //put your code here
    var $timestamps = FALSE;

    static function get_by_serial_number($serial_number) {

        return self::where('nr', '=', $serial_number)->get();
    }

	 static function last() {
		return DB::table('next_withdrawals')->orderBy('id', 'desc')->first();
	}

}
