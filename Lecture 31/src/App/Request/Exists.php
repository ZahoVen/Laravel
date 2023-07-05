<?php

namespace src\App\Request;

class ExistsOffset extends SuperGlobals implements ArrayAccess
{
    public function offsetExists($offset) {
        return isset(self::$post[$offset]) || isset(self::$get[$offset]) || isset(self::$session[$offset]);
    }

}