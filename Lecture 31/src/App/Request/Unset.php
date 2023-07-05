<?php

namespace src\App\Request;

class UnsetOffset extends SuperGlobals implements ArrayAccess
{
    public function offsetUnset($offset) {
        if (isset(self::$post[$offset])) {
            unset(self::$post[$offset]);
        } elseif (isset(self::$get[$offset])) {
            unset(self::$get[$offset]);
        } elseif (isset(self::$session[$offset])) {
            unset(self::$session[$offset]);
        }
    }
    
}
