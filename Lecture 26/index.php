<?php

require_once __DIR__ . '/person.php';
require_once __DIR__ . '/calculator.php';
require_once __DIR__ . '/car.php';
require_once __DIR__ . '/bankaccount.php';

$personInfo = new Person('John', 43, 'example@some.com');
echo $personInfo->getPersonInfo() . "\n";

$calc = new Calculator(10); 
$calc->add(5);
$calc->subtract(3); 
$calc->multiply(2); 
$calc->divide(4); 
echo 'The result from the calculation is: ' . $calc->getCurrentValue() . "\n";

$car = new Car('Mazda', 'CX-5', 2016);
echo $car->getMake() . ' ' . $car->getModel() . ' ' . $car->getYear() . "\n";

// create a new bank account
$bankAccount = new BankAccount('123456', 1000, 5);

// deposit some money
$bankAccount->deposit(500) . "\n";

// withdraw some money
$bankAccount->withdraw(200) . "\n";

// add interest
$bankAccount->getInterestRate() . "\n";

// get the account details
echo $bankAccount->getAccountInfo() . "\n"; // Output: Account details: Account Number: 123456, Balance: 1326.25, Interest Rate: 5%
