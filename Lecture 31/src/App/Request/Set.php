<?php

namespace src\App\Request;

class SetOffset extends SuperGlobals implements ArrayAccess
{

    public function offsetSet($offset, $value) {
        if (isset(self::$post[$offset])) {
            self::$post[$offset] = $value;
        } elseif (isset(self::$get[$offset])) {
            self::$get[$offset] = $value;
        } elseif (isset(self::$session[$offset])) {
            self::$session[$offset] = $value;
        }
    }

}