<?php

class BankAccount {
    private $accountNumber;
    private $balance;
    private $interestRate;
    private $calculator;

    public function __construct($accountNumber, $balance, $interestRate) {
        $this->accountNumber = $accountNumber;
        $this->balance = $balance;
        $this->interestRate = $interestRate;
        $this->calculator = new Calculator($balance);
    }

    public function deposit($amount) {
        $this->calculator->add($amount);
        $this->balance = $this->calculator->getCurrentValue();
    }

    public function withdraw($amount) {
        $this->calculator->subtract($amount);
        $this->balance = $this->calculator->getCurrentValue();
    }

    private function calculateInterest() {
        $interest = $this->balance * $this->interestRate;
        $this->calculator->add($interest);
        $this->balance = $this->calculator->getCurrentValue();
    }

    public function getAccountNumber() {
        return $this->accountNumber;
    }

    public function getBalance() {
        return $this->balance;
    }

    public function getInterestRate() {
        return $this->interestRate;
    }

    public function applyInterest() {
        $this->calculateInterest();
    }

    public function getAccountInfo() {
        return 'Account Number: ' . $this->accountNumber . ', Balance: ' . $this->balance . ', Interest Rate: ' . $this->interestRate;
    }

    public function getOwnerInfo($name, $age, $email) {
        $person = new Person($name, $age, $email);
        return $person->getPersonInfo();
    }
}
