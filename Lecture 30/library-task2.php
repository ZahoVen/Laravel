<?php

class SuperGlobals implements ArrayAccess {
    
    protected static $post;
    protected static $get;
    protected static $session;

    public function __construct() {
        self::$post = $_POST;
        self::$get = $_GET;
        if (isset($_SESSION)) {
        self::$session = $_SESSION;
        } else {
        self::$session = [];
        }
    }
    public function __set($name, $value) {
        switch ($name) {
            case 'post':
                self::$post = $value;
                break;
            case 'get':
                self::$get = $value;
                break;
            case 'session':
                self::$session = $value;
                break;
        }
    }

    public function __get($name) {
        switch ($name) {
            case 'post':
                return self::$post;
            case 'get':
                return self::$get;
            case 'session':
                return self::$session;
        }
    }

    

    public function offsetExists($offset) {
        return isset(self::$post[$offset]) || isset(self::$get[$offset]) || isset(self::$session[$offset]);
    }

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

    public function offsetSet($offset, $value) {
        if (isset(self::$post[$offset])) {
            self::$post[$offset] = $value;
        } elseif (isset(self::$get[$offset])) {
            self::$get[$offset] = $value;
        } elseif (isset(self::$session[$offset])) {
            self::$session[$offset] = $value;
        }
    }

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


