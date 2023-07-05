<?php
$xml = new DOMDocument();
$xml->load('dataset.xml');

$dtd = new DOMDocument();
$dtd->load('data.dtd');

$xsd = new DOMDocument();
$xsd->load('data.xsd');

$isValid = $xml->schemaValidate($xsd->documentURI);
$isValid = $xml->validate();

if ($isValid === true) {
    echo 'Validation succeeded';
} else {
    echo 'Validation failed';
}