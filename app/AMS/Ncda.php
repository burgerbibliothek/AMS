<?php
namespace App\AMS;
use App\AMS\ARK;

class Ncda {

	/**
     * Calculate a checkdigit.
	 * Reference: https://metacpan.org/dist/Noid/view/noid#NOID-CHECK-DIGIT-ALGORITHM
     */
	static public function calc($id, $xdigits)
	{
				
		// Check if $id only contains characters which are in $xdigits
		if(preg_match_all('/[\/'.$xdigits.']/', $id) !== strlen($id)){
			return false;
		}

		// Make sure xdigits only contains unique values
		$xdigits = array_unique(str_split($xdigits));

		// Sort array
		sort($xdigits);

		// Calculate the checkdigit
		$xdigitValues = array_flip($xdigits);
		$chars = str_split($id);
		$sum = 0;

		forEach($chars as $index => $value)
		{
			if(isset($xdigitValues[$value])){
				$sum += $xdigitValues[$value] * ($index + 1);
			}
		}

		$checkDigit = $sum % count($xdigits);
		return $xdigits[$checkDigit];
	}

	/**
     * Verify if an ID conforms to the Noid Check Digit Algorithm (NCDA)
     */
	static public function verify($id, $xdigit)
	{

		$id = str_split($id, strlen($id) - 1);
		$checkId = Ncda::calc($id[0], $xdigit);

		if($id[1] === $checkId){
			return true;
		}

		return false;
	}
	
}