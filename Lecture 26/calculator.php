<?php
class Calculator {
    private $currentValue;

    public function __construct($initialValue) {
        $this->currentValue = $initialValue;
    }

    public function add($value) {
        $this->currentValue += $value;
    }

    public function subtract($value) {
        $this->currentValue -= $value;
    }

    public function multiply($value) {
        $this->currentValue *= $value;
    }

    public function divide($value) {
        if ($value == 0) {
            throw new Exception('Division by zero error');
        }
        $this->currentValue /= $value;
    }

    public function getCurrentValue() {
        return $this->currentValue;
    }
}
