<?php

$xml = simplexml_load_file('dataset.xml');

$html = '<table>';
foreach ($xml->children() as $row) {
    $html .= '<tr>';
    foreach ($row->children() as $cell) {
        $html .= '<td>' . $cell . '</td>';
    }
    $html .= '</tr>';
}
$html .= '</table>';

file_put_contents('dataset.html', $html);

$csv = '';
foreach ($xml->children() as $row) {
    foreach ($row->children() as $cell) {
        $csv .= '"' . str_replace('"', '""', $cell) . '",';
    }
    $csv = rtrim($csv, ',') . "\n";
}

file_put_contents('dataset.csv', $csv);
