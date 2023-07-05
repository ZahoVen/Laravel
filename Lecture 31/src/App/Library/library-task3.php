<?php

namespace scr\App\Library;

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

}