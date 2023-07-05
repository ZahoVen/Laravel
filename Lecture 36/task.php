<?php

class Config {
    public $settings;

    public function __construct() {
        $this->settings = new stdClass();
    }

    public function set(string $key, $value) {
        $this->settings->$key = $value;
    }

    public function get(string $key) {
        if (isset($this->settings->$key)) {
            return $this->settings->$key;
        }
        return null;
    }

    public function remove(string $key) {
        if (isset($this->settings->$key)) {
            unset($this->settings->$key);
        }
    }

    public function has(string $key) {
        return isset($this->settings->$key);
    }

    public function clear() {
        $this->settings = new stdClass();
    }
    
    public function saveToFile(string $filename) {
        $jsonData = json_encode($this->settings, JSON_PRETTY_PRINT);
        file_put_contents($filename, $jsonData);
    }

    public function loadFromFile(string $filename) {
        if (!file_exists($filename)) {
            throw new Exception("File not found: $filename");
        }

        $json = file_get_contents($filename);
        $data = json_decode($json);

        if (!is_object($data)) {
            throw new Exception("Invalid JSON format in file: $filename");
        }

        // merge loaded values with existing configuration values
        foreach ($data as $key => $value) {
            $this->settings->$key = $value;
        }
    }
}
