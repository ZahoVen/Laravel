<?php

require_once 'ViewClasses.php';


class Control {
    private $event;
    private $view;
    private $key;
    private $jsonFilePath = 'datafile.json';


    public function __construct()
    {
        $this->event = new Events;
        $this->view = new ViewFirstPage;
        $this->key = NULL;
    }

    public function print() {
        if (isset($_POST['addEvent'])){
                self::addEvent();
                //$this->event->addEvent(self::getNewEvent());
        }

            else if(isset($_POST['deleteBtn'])){
                $this->event->deleteEvent($_POST['deleteBtn']);
                echo $this->view->printHTML($this->event);

            }

            else if(isset($_POST['edit'])){
                $this->key = $_POST['edit'];
                self::getEditedEvent($_POST['edit']);
            }

            else if (isset($_POST['saveEdited'])){
                $this->event->editEvent($_POST['saveEdited'], self::getNewEvent());
                echo $this->view->printHTML($this->event);
            }
            else if(isset($_POST['add'])){
                $this->event->addEvent(self::getNewEvent());
                echo $this->view->printHTML($this->event);
            }
            else{
                echo $this->view->printHTML($this->event);
            }
        
    }
    private function getNewEvent() {
        $new_event = array();
        $lastEventTotalOdo = $this->getLastEventTotalOdo();
        if(!$_POST['date'] == NULL){
            $new_event = [
            'date' => $_POST['date'] ?? NULL,
            'distance' => $_POST['distance'] ?? 0,
            'total_odo' => $_POST['distance'] + $lastEventTotalOdo,
            'fuel_quantity' => $_POST['fuel_quantity'] ?? 0,
            'fuel_amount' => $_POST['fuel_amount'] ?? 0,
            'total_price' => $_POST['fuel_amount'] * $_POST['fuel_quantity'] ?? NULL,
            'gas_station_name' => $_POST['gas_station_name'] ?? NULL,
            'gas_station_product' => $_POST['gas_station_product'] ?? NULL,
            'driving_type' => $_POST['driving_type'] ?? NULL,
            ];
        return $new_event;
        }
        else{echo '<script>alert("The date can not be empty!")</script>';}
    }
    private function getEditedEvent($id) {
        $new_view = new ViewEditPage;
        $old_event = $this->event->getAllEvents()[$id]; // Вземете старото събитие от масива със всички събития
        $calculations = $this->event->EditingTable($old_event); // Изчислете старите стойности
        echo $new_view->printHTML($calculations, $id); // Предайте старите стойности и ID на изгледа за редакция
    }
    
    public function generateReport($gas_station, $fuel_type, $driving_type) {
        $jsonData = file_get_contents($this->jsonFilePath);
        $data = json_decode($jsonData, true);
        $matchingEvents = array();

        foreach ($data['refuel_events'] as $event) {
            if ($event['gas_station_name'] === $gas_station && 
                $event['gas_station_product'] === $fuel_type && 
                $event['driving_type'] === $driving_type) {
                $matchingEvents[] = $event;
            }
        }
        if (isset($_POST['reportBtn'])) {
            $control->generateReport($_POST['gas_station'], $_POST['gas_station_product'], $_POST['driving_type']);
        }
        
        $this->view->printTable3($matchingEvents);
    }

    private function getLastEventTotalOdo() {
        $jsonData = file_get_contents($this->jsonFilePath);
        $data = json_decode($jsonData, true);
        $refuelEvents = $data['refuel_events'];
        $lastEvent = end($refuelEvents);
        return $lastEvent['total_odo'];
    }

    private function addEvent() {
        $new_view = new ViewAdd;
        echo $new_view->printHTML();
    }
}

$control = new Control;
$control->print();
