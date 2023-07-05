<?php

class Person{
    private $details;
    
    public function __construct($name, $age, $email){
        $this->details = [
            'name' => $name,
            'age' => $age,
            'email' => $email
        ];
    }

    public function getPersonInfo(){
        return 'Person details are: ' . implode(", ", $this->details);
    }

}