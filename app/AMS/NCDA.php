<?php
namespace App\AMS;
use App\AMS\ARK;

class NCDA {

	/**
     * Calculate a checkdigit.
	 * Implementation of the Noid Check Digit Algorithm (NCDA)
	 * Reference: https://metacpan.org/dist/Noid/view/noid#NOID-CHECK-DIGIT-ALGORITHM
     */
	static public function calc($id, $xdigit = ARK::XDIGIT['betanumeric-vowel-ell']) {

		$xdigit = str_split($xdigit);
		$xdigitValues = array_flip($xdigit);
		$chars = str_split($id);

		$sum = 0;
		$i = 1;

		forEach ($chars as $c) {

			if (!isset($xdigitValues[$c])) {
				$sum += 0;
			} else {
				$sum += $xdigitValues[$c] * $i;
			}
			$i++;
		}

		$checkNum = $sum % count($xdigit);
		return $xdigit[$checkNum];
	}

	/**
     * Verify if an ID conforms to the Noid Check Digit Algorithm (NCDA)
     */
	static public function verify($id, $xdigit = ARK::XDIGIT['betanumeric-vowel-ell']) {

		$checkDigitInput = substr($id, -1);
		$checkDigit = NCDA::calc(substr($id, 0, -1));

		if($checkDigit !== $checkDigitInput){
			return false;
		}

		return true;

	}
}