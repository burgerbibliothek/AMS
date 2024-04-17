<?php

namespace App\AMS;

class Validator{

    public static function validArkCharacterRepetoire($repetoire){
        return preg_match('/[^A-Za-z0-9=~*+@_$]/', $repetoire) > 0 ? false : true;
    }

    public static function validNaan($naan){
        return preg_match('/[^0-9bcdfghjkmnpqrstvwxz]/', $naan) > 0 ? false : true;
    }
    
}