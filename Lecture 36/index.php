<?php

require_once __DIR__ . '/task.php';


$config = new Config();


$config->set('db_host', 'localhost');
$config->set('db_user', 'root');
$config->set('db_pass', 'password123');
$config->set('db_name', 'mydatabase');
$config->saveToFile('config.json');

echo $config->get('db_user') . PHP_EOL; // Output: root

$config->remove('db_pass');

// Verify that a configuration value exists
if ($config->has('db_name')) {
    echo "db_name exists" . PHP_EOL;
} else {
    echo "db_name does not exist" . PHP_EOL;
}

// Clear all configuration values
$config->clear();

// Create a sample JSON file with configuration data
$configData = [
    'db_host' => 'localhost',
    'db_user' => 'myuser',
    'db_pass' => 'mypassword',
    'db_name' => 'mydatabase',
];
$jsonData = json_encode($configData, JSON_PRETTY_PRINT);
file_put_contents('config.json', $jsonData);

// Load the configuration data into a Config object
$config->loadFromFile('config.json');

// Check that the loaded configuration values are available in the object
echo $config->get('db_host') . PHP_EOL; // Output: localhost
echo $config->get('db_user') . PHP_EOL; // Output: myuser
echo $config->get('db_pass') . PHP_EOL; // Output: mypassword
echo $config->get('db_name') . PHP_EOL; // Output: mydatabase

$filename = 'config.json';
try {
    $config->saveToFile($filename);
    echo "Configuration values saved to file: $filename\n";
} catch (Exception $e) {
    echo "Error saving configuration values to file: " . $e->getMessage() . "\n";
}

// Verify that the saved JSON file contains the correct data
try {
    $jsonData = file_get_contents($filename);
    $data = json_decode($jsonData, true);
    if ($data['db_host'] === 'localhost' &&
        $data['db_user'] === 'myuser' &&
        $data['db_pass'] === 'mypassword' &&
        $data['db_name'] === 'mydatabase') {
        echo "Saved configuration values are correct\n";
    } else {
        echo "Saved configuration values are incorrect\n";
    }
} catch (Exception $e) {
    echo "Error reading configuration values from file: " . $e->getMessage() . "\n";
}