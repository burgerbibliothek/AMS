<?php
namespace App\AMS;
use App\AMS\NCDA;
use App\Models\Minter;
use App\Models\Naan;

class Ark {

	/**
     * Generates a random ARK with given NAAN.
	 * @naan = Name Assigning Authority Name
	 * @length = Stringlenght of generated ARK
	 * @xdigit = Digits whicht should be used for generating ARK
	 * @ncda = set fals to not include a checkdigit
     */
	public static function generate($naan, $shoulder = null){

		// Retrieve settings
		$record = Naan::leftJoin('minter_settings', 'minter_settings.id', '=', 'naans.minter_id')->firstWhere('naan', $naan);
		
		if(!$record){
			return false;
		}

		$lengthId = $record->length;
		$xdigits = $record->xdigits;
		$id = $naan.'/';
		
		$xdigitsArr = str_split($xdigits);
		$xdigitsLength = count($xdigitsArr) - 1;

		// Check if NAAN has valid shoulders.
		if($shoulder){
			
		}

		$id .= $shoulder;

		// Length can't be longer then xdigits length in order for the NCDA to work.
		if($lengthId > $xdigitsLength){
			return false;
		}

		// Generate a random ID based on the submited xdigits.
		while ($lengthId > 0) {
			$random = random_int(0, $xdigitsLength);
			$id .= $xdigits[$random];
			$lengthId--;
		}

		// Calculate the check digit for the ID
		if ($record->ncda) {
			$id = $id . NCDA::calc($id, $xdigits);
		}
		
		return $id;

	}

}