<?php
$xml = simplexml_load_file('dataset.xml');

echo '<table>';
echo '<thead><tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Gender</th><th>IP Address</th></tr></thead>';
echo '<tbody>';

foreach ($xml->record as $record) {
    echo '<tr>';
    echo '<td>' . htmlentities($record->id) . '</td>';
    echo '<td>' . htmlentities($record->first_name) . '</td>';
    echo '<td>' . htmlentities($record->last_name) . '</td>';
    echo '<td>' . htmlentities($record->email) . '</td>';
    echo '<td>' . htmlentities($record->gender) . '</td>';
    echo '<td>' . htmlentities($record->ip_address) . '</td>';
    echo '</tr>';
}

echo '</tbody>';
echo '</table>';

