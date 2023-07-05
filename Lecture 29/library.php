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
    public static function setPost($key, $value) {
        self::$post[$key] = $value;
    }

    public static function getPost($key) {
        return isset(self::$post[$key]) ? self::$post[$key] : null;
    }

    public static function setGet($key, $value) {
        self::$get[$key] = $value;
    }

    public static function getGet($key) {
        return isset(self::$get[$key]) ? self::$get[$key] : null;
    }

    public static function setSession($key, $value) {
        self::$session[$key] = $value;
    }

    public static function getSession($key) {
        return isset(self::$session[$key]) ? self::$session[$key] : null;
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


