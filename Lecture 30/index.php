<?php

define('__ROOT__', dirname(__FILE__));

require_once __ROOT__ . '/library-task2.php';

$globals = new SuperGlobals();

$globals->post = ['name' => 'John'];
if (isset($globals->get['name'])) {
    echo $globals->get['name'];
}

$globals->offsetSet('user', 'john@example.com');

if (isset($globals['John'])) {
   echo 'The value exists';
}

unset($globals['name']);
