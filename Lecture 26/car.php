<?php

class Car {
    protected $_make;
    protected $_model;
    protected $_year;


    public function __construct($make, $model, $year){
        $this->_make = $make;
        $this->_model = $model;
        $this->_year = $year;
    }

    public function getMake(){
        return $this->_make;
    }

    public function getModel(){
        return $this->_model;
    }

    public function getYear(){
        return $this->_year;
    }
}