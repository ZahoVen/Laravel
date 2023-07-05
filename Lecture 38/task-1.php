<?php

$xml = simplexml_load_file("dataset.xml");

// Get all the tags in the XML file
$tags = array();
foreach ($xml->xpath('//*') as $element) {
    $tags[] = $element->getName();
}

sort($tags);

foreach ($tags as $tag) {
    echo $tag . "\n";
}
