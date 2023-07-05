<?php

abstract class TestAnonymus {
    public function One(){
        echo "Trying anonymous classes \n";
    }
}

interface Test2 {
    public function Two();
}

try {
    // Create an anonymous class
    $obj = new class() extends TestAnonymus implements Test2 {
        public function Two(){
            echo "Inherit and implements \n";
        }
    };

    // Try to extend the anonymous class
    $obj1 = new class() extends get_parent_class($obj) implements Test2 {
        public function Two(){
            echo "Trying to extend anonymous class \n";
        }
    };

    // Call the methods of the objects
    $obj->One();
    $obj->Two();
    $obj1->Two();
} catch (ParseError $e) {
    // Handle the error
    echo "Error: Extending anonymous class is not allowed.\n";
}
