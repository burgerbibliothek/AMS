<?php
namespace App\AMS;
use App\AMS\Minter;
use App\Models\Naan as NaanModel;

class ARK {

	/**
     * Possible digits for ARK generation.
     */
	public const XDIGIT = [
		'numeric' => '123456789',
		'alphanumeric' => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
		'alphanumeric-vowel' => '0123456789bcdfghjklmnpqrstvwxzBCDFGHJKLMNPQRSTVWXZ',
		'alphanumeric-vowel-ell' => '0123456789bcdfghjkmnpqrstvwxzBCDFGHJKLMNPQRSTVWXZ',
		'betanumeric' => '0123456789abcdefghijklmnopqrstuvwxyz',
		'betanumeric-vowel' => '0123456789bcdfghjklmnpqrstvwxz',
		'betanumeric-vowel-ell' => '0123456789bcdfghjkmnpqrstvwxz',
		'all' => '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvxyz=#*+@_$',
	];

	protected array $naan;

	public function __construct() {
		$naans = NaanModel::all('naan')->pluck('naan');
		$this->naan = $naans->all();
	}

	/**
     * Generates a random ARK with given NAAN.
	 * @naan = Name Assigning Authority Name
	 * @length = Stringlenght of generated ARK
	 * @xdigit = Digits whicht should be used for generating ARK
	 * @ncda = set fals to not include a checkdigit
     */
	public function generate($naan, $length = 5, $xdigit = ARK::XDIGIT['betanumeric-vowel-ell'], $ncda = true){
		
		// Check if NAAN is in configuration file.
		if(!in_array($naan, $this->naan)){
			return;
		}
		
		$id = Minter::generateID($naan, $length, $xdigit, $ncda);
		return $id;

	}

	protected function retrieve($ark){

		// if in database return values
		// if not in database check for error and return message
		//// check if only valid characters
		//// check if ncda correct
	}

}