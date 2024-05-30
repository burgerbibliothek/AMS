<?php
namespace App\AMS;
use App\AMS\Ncda;
use App\Models\Naan;

class Ark {

	/**
     * Generates a random ARK with given NAAN.
	 * @naan = Name Assigning Authority Name
     */
	public static function generate($naan)
	{

		// Get minter settings for NAAN
		$record = Naan::leftJoin('minter_settings', 'minter_settings.id', '=', 'naans.minter_settings_id')->firstWhere('naan', $naan);
		
		if(!$record){
			return false;
		}

		$lengthId = $record->length;
		$xdigits = $record->xdigits;
		$id = $naan.'/';
		
		$xdigitsArr = str_split($xdigits);
		$xdigitsLength = count($xdigitsArr) - 1;

		// TODO: Implement shoulders
		/*
		if($shoulder){}
		$id .= $shoulder;
		*/

		/**
		 * Length can't be longer then xdigits length in order for the NCDA to work.
		 * https://metacpan.org/dist/Noid/view/noid#NOID-CHECK-DIGIT-ALGORITHM
		 */
		if($lengthId > $xdigitsLength){
			return false;
		}

		// Generate random ID based on minter settings
		while ($lengthId > 0) {
			$random = random_int(0, $xdigitsLength);
			$id .= $xdigits[$random];
			$lengthId--;
		}

		// Add check digit
		if ($record->ncda) {
			$id = $id . Ncda::calc($id, $xdigits);
		}
		
		return $id;

	}	

}