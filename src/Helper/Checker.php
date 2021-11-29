<?php
namespace App\Helper;

class Checker {

    private $valid=false;

    public function isValid($val="B"){
        if($val == "A"){
            $this->valid=true;
        }
        return $this->valid;
    }   
    public function get(){
        return $this->valid; 
    }

}