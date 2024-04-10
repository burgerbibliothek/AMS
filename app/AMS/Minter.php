<?php
namespace App\AMS;
use App\AMS\ARK;
use App\AMS\NCDA;

class Minter {

	/**
     * Generate a random ID.
     */
	static public function generateID($naan, $length = 5, $xdigit = ARK::XDIGIT['betanumeric-vowel-ell'], $ncda = true) {

		// The ID must have at least a length of 2.
		if ($length < 2) {
			return false;
		}

		$xdigit = str_split($xdigit);
		$xdigitLength = count($xdigit) - 1;
		$id = $naan.'/';

		// Length can't be longer then xdigits length in order for the NCDA to work.
		if($ncda && $length > $xdigitLength){
			return false;
		}

		// Generate a random ID based on the submited xdigits.
		while ($length > 0) {
			$random = random_int(0, $xdigitLength);
			$id .= $xdigit[$random];
			$length--;
		}

		// Calculate the check digit for the ID
		if ($ncda) {
			$id = $id . NCDA::calc($id);
		}

		return $id;
	}

}