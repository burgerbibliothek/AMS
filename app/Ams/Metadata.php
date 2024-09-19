<?php

namespace App\Ams;

class Metadata{  
    
    public static function encodeMetadata($type, $data){

        $metadata = ["metadata" => []];

        $data = [];
        foreach ($data as $d) 
        {
        }

        $test = json_decode('{
  "metadata" : [{
    "type":"kernel",
    "data": {
      "who": ["Gibbon, Edward"], 
      "what": ["The Decline and Fall of the Roman Empire"],
      "when": ["1781"], 
      "where" : ["http:\/\/www.ccel.org\/g\/gibbon\/decline\/"]
    }
  }]
}',1);

        dump($test);
        
        
    }

}