<?php

define('__ROOT__', dirname(__FILE__));

require_once __ROOT__ . '\src\App\Library\library-task3.php';
require_once __ROOT__ . '\src\App\Request\ExistsOffset.php';
require_once __ROOT__ . '\src\App\Request\GetOffset.php';
require_once __ROOT__ . '\src\App\Request\SetOffset.php';
require_once __ROOT__ . '\src\App\Request\UnsetOffset.php';

use App\Request\SuperGlobals;
use App\Request\ExistsOffset;
use App\Request\GetOffset;
use App\Request\SetOffset;
use App\Request\UnsetOffset;

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

$get_offset = new GetOffset();
echo $get_offset['name'];

$set_offset = new SetOffset();
$set_offset['name'] = 'Alice';

$unset_offset = new UnsetOffset();
unset($unset_offset['name']);
