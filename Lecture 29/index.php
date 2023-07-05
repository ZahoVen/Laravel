<?php

require_once __DIR__ . '/library.php';


session_start(); // Start the session
$superGlobals = new SuperGlobals();
SuperGlobals::setPost('myKey', 'myValue');
$myValue = SuperGlobals::getPost('myKey');
$myValueArray = $superGlobals['myKey'];
SuperGlobals::setSession('mySessionKey', 'mySessionValue');
$mySessionValue = SuperGlobals::getSession('mySessionKey');
$mySessionValueArray = $superGlobals['mySessionKey'];
