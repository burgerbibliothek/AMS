<?php

namespace App\AMS;

class Validator{

    /**
     * Check if string contains characters which are valid for forming ARKs
     * https://www.ietf.org/archive/id/draft-kunze-ark-39.html#name-character-repertoires
     */
    public static function validArkCharacterRepetoire($repetoire){
        return preg_match('/[^A-Za-z0-9=~*+@_$]/', $repetoire) > 0 ? false : true;
    }

    /**
     * Check if string contains characters which are valid for forming NAANs
     * https://www.ietf.org/archive/id/draft-kunze-ark-39.html#name-the-name-assigning-authorit
    */
    public static function validNaan($naan){
        return preg_match('/[^0-9bcdfghjkmnpqrstvwxz]/', $naan) > 0 ? false : true;
    }
    
}