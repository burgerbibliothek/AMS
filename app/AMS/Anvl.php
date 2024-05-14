<?php
namespace App\AMS;

class Anvl{

    public $record;
    protected array $recordArray;
    protected int $linelength;

    function __construct($linelength = 72)
    {
        $this->linelength = $linelength;  
    }

    public function add($name, $value)
    {   
        if(is_array($value)){
            $value = implode(" | ", $value);
        }

        $this->recordArray[$name] = trim($value);
    }

    public function addMultiple(array $data){

        foreach($data as $name => $value){
            $this->add($name, $value);
        }

    }

    public function record(){
        
        $this->record = null;

        foreach($this->recordArray as $name => $value){
            
            $separator = $name === '#' ? chr(32) : chr(58).chr(32);
            
            if($this->linelength){
                $value =  wordwrap($value, $this->linelength, chr(13).chr(10).chr(9));
            }
            
            $this->record .= $name.$separator.$value.chr(13).chr(10);
        
        }

        $this->record .= chr(13).chr(10);

        return $this->record;
    }


}