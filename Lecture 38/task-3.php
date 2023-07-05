<?php
$xml = simplexml_load_file('dataset.xml');
$json = json_encode($xml, JSON_PRETTY_PRINT);

file_put_contents('data.json', $json);
