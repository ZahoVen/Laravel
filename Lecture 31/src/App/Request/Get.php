<?php

namespace src\App\Request;

class GetOffset extends SuperGlobals implements ArrayAccess 
{
    
    public function offsetGet($offset) {
        if (isset(self::$post[$offset])) {
            return self::$post[$offset];
        } elseif (isset(self::$get[$offset])) {
            return self::$get[$offset];
        } elseif (isset(self::$session[$offset])) {
            return self::$session[$offset];
        } else {
            return null;
        }
    }
}