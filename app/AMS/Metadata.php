<?php
namespace App\AMS;

class Metadata {

    public static function parseKernelMetadata(string $metadata) : ?array
    {

        $rows = explode(chr(0x0A), $metadata);
        
        if(!empty($rows[count($rows)-1]) && !empty($rows[count($rows)-2])){
            return null;
        }

        $rows = array_slice($rows, 0, -2);

        if(trim($rows[0]) !== 'erc:'){
            return null;
        }

        foreach($rows as $row){
            $pair = explode(':',trim($row));
            $kernel[$pair[0]] = $pair[1]; 
        }

        if(!array_key_exists('who', $kernel) || !array_key_exists('what', $kernel) || !array_key_exists('when', $kernel) || !array_key_exists('where', $kernel)){
            return null;
        }
        
        return $kernel;
    }

    public static function serizalizeKernelMetadata(array $kernel) : ?array
    {
        
    }

}