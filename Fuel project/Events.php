<?php
 
class Events {
    const JSON_FILE = 'datafile.json';
    private $data = NULL;
    private $last_refuel = NULL;
 
    private function calculateAverageRefuelPeriod($refuel_events) {
        $total_period = 0;
        $count = count($refuel_events);
 
        if ($count > 1) {
            $first_refuel = reset($refuel_events);
            $last_refuel = end($refuel_events);
            $start_date = strtotime($first_refuel['date']);
            $end_date = strtotime($last_refuel['date']);
            $total_period = ($end_date - $start_date) / ($count - 1)/ (24 * 60 * 60);;
        }
 
        return round($total_period,2);
    }
 
    public function __construct() {
        if(is_null($this->data)){
            if(file_exists(Events::JSON_FILE)){
                $json = file_get_contents(Events::JSON_FILE);
                $this->data = json_decode($json, true);
                self::setLastEvent();  
            }
            else{
                echo 'File not exists!';
            }
        }
    }
 
    public function getBySelected($selected) {
        $result = array();
        $full_data = self::getAllEvents();
 
        if ($selected['gas_station_name'] == 'Без значение бензиностанция' && $selected['gas_station_product'] != 'Без значение марка гориво') {
            echo '<script>alert("Invalid choices!")</script>';
        } else if ($selected['gas_station_name'] != 'Без значение бензиностанция') {
            if ($selected['gas_station_product'] != 'Без значение марка гориво') {
                if ($selected['driving_type'] != "Без значение вид на шофиране") {
                    foreach ($full_data as $event) {
                        if ($event['gas_station_name'] == $selected['gas_station_name'] &&
                            $event['gas_station_product'] == $selected['gas_station_product'] &&
                            $event['driving_type'] == $selected['driving_type']
                        ) {
                            array_push($result, $event);
                        }
                    }
                    if (empty($result)) {
                        echo '<script>alert("You do not have any data with this combination!")</script>';
                    }
                } else {
                    foreach ($full_data as $event) {
                        if ($event['gas_station_name'] == $selected['gas_station_name'] &&
                            $event['gas_station_product'] == $selected['gas_station_product']
                        ) {
                            array_push($result, $event);
                        }
                    }
                    if (empty($result)) {
                        echo '<script>alert("You do not have any data with this combination!")</script>';
                    }
                }
            } else {
                foreach ($full_data as $event) {
                    if ($event['gas_station_name'] == $selected['gas_station_name']) {
                        array_push($result, $event);
                    }
                }
                if (empty($result)) {
                    echo '<script>alert("You do not have any data with this combination!")</script>';
                }
            }
        } else if ($selected['driving_type'] != "Без значение вид на шофиране") {
            foreach ($full_data as $event) {
                if ($event['driving_type'] == $selected['driving_type']) {
                    array_push($result, $event);
                }
            }
            if (empty($result)) {
                echo '<script>alert("You do not have any data with this combination!")</script>';
            }
        } else {
            return $full_data;
        }
 
        return $result;
    }
    public function addEvent($event) {
        array_push($this->data['refuel_events'], $event);
        self::saveFile();
    }    
    public function deleteEvent($id) {
        if(isset($this->data['refuel_events'][$id])) {
            unset($this->data['refuel_events'][$id]);
            self::saveFile();
        }
    }
 
    public function editEvent($id, $newEvent) {
            $this->data['refuel_events'][$id] = $newEvent;
 
            self::saveFile();
    }
    private function removeEmptyEvents(){
        foreach($this->data['refuel_events'] as $key => $event) {
            if(!($event['date'])){
                unset($this->data['refuel_events'][$key]);
            }
        }
    }
    private function setLastEvent() {
        self::removeEmptyEvents();
        $this->last_refuel = end($this->data['refuel_events']);
 
    }
 
    private function saveFile() {
        $json = json_encode($this->data, JSON_PRETTY_PRINT);
            file_put_contents(Events::JSON_FILE, $json);
    }
 
 
    private function findMinCostPerDistance($refuel_events) {
        $min_cost_per_distance = PHP_FLOAT_MAX;
 
        foreach ($refuel_events as $event) {
            $distance = $event['distance'] ?? 0;
            $total_price = $event['total_price'] ?? 0;
 
            if ($distance != 0) {
                $cost_per_distance = $total_price / $distance;
                $min_cost_per_distance = min($min_cost_per_distance, $cost_per_distance);
            }
        }
 
        return round($min_cost_per_distance, 2);
    }
    private function findMinConsumationOfFuel($refuel_events) {
        $min_fuel_consumption = PHP_FLOAT_MAX;
 
        foreach ($refuel_events as $event) {
            $distance = $event['distance'] ?? 0;
            $fuel_quantity = $event['fuel_quantity'] ?? 0;
 
            if ($distance != 0) {
                $fuel_consumption = round($fuel_quantity / ($distance / 100), 2);
                $min_fuel_consumption = min($min_fuel_consumption, $fuel_consumption);
            }
        }
 
        return $min_fuel_consumption;
 
    }
    public function Table1() {
            $calculations = array();
            $calculations['Изминато разстояние'] = $this->last_refuel['distance'] ?? 0;
 
            $fuel_last_period = $this->last_refuel['fuel_quantity'] ?? 0;
            $calculations['Разход на гориво'] = $this->last_refuel['distance'] != 0 ? round($fuel_last_period 
                                                        / ($this->last_refuel['distance'] / 100),2) : 0;
 
            $cost_last_period = $this->last_refuel['total_price'] ?? 0;
            if($this->last_refuel['distance'] != 0){
                $cost_last_period /= $this->last_refuel['distance'];
                $calculations['Цена за разстояние'] = $cost_last_period = round($cost_last_period, 2);
            }
            else {
                $calculations['Цена за разстояние'] = 0;
            }
            return $calculations;
        }
 
 
    public function EditingTable($old_event) {
        $calculations = array();
        $calculations['Дата'] = $old_event['date'];
        $calculations['Изминато разстояние'] = $old_event['distance'];
        $calculations['Общо изминато разстояние'] = $old_event['total_odo'];
        $calculations['Заредени литри'] = $old_event['fuel_quantity'];
        $calculations['Цена на литър'] = $old_event['fuel_amount'];
        $calculations['Обща сума'] = $old_event['total_price'];
        $calculations['Бензиностанция'] = $old_event['gas_station_name'];
        $calculations['Марка гориво'] = $old_event['gas_station_product'];
        $calculations['Вид на шофиране'] = $old_event['driving_type'];
        return $calculations;
    }
 
 
 
    public function Table2() {
        $calculations = array();
        $refuel_events = $this->data['refuel_events'] ?? [];
        $total_refuel_events = count($refuel_events);
        $months = [];
        foreach ($refuel_events as $refuel) {
            $month = date('m', strtotime($refuel['date']));
            $months[$month] = isset($months[$month]) ? $months[$month] + 1 : 1;
        }
        $calculations['Среден брой зареждания в месец'] = $total_refuel_events / count($months);
 
        $totalPrice = 0;
        foreach ($this->data['refuel_events'] as $event) {
            $totalPrice += $event['total_price'];
        }
        $calculations['Средна цена на месец'] = round($totalPrice / count($months),2);
 
        $totalFuel = 0;
        foreach ($this->data['refuel_events'] as $event) {
            $totalFuel += $event['fuel_quantity'];
        }
        $calculations['Средно количество гориво на месец'] = $totalFuel / count($months);
 
        $total_distance = 0;
        foreach ($this->data['refuel_events'] as $event) {
            $total_distance += $event['distance'];
        }
        $total_distance = 0;
        $refuel_events = $this->data['refuel_events'] ?? [];
        $count = count($refuel_events);
 
        foreach ($refuel_events as $event) {
            $total_distance += $event['distance'];
        }
 
        $calculations['Среден период на зареждане'] = $this->calculateAverageRefuelPeriod($refuel_events);
        $calculations['Среден разход на гориво'] = round($totalFuel / $total_distance * 100,2);
 
        $calculations['Средна цена за разстояние'] = round($totalPrice / $total_distance,2);
        return $calculations;
    }
 
    public function Table3() {
        $calculations = array();
        $fuel_last_period = $this->last_refuel['fuel_quantity'] ?? 0;
        $calculations['Среден разход на гориво'] = $this->last_refuel['distance'] != 0 ? round($fuel_last_period 
        / ($this->last_refuel['distance'] / 100),2) : 0;
        $cost_last_period = $this->last_refuel['total_price'] ?? 0;
        if($this->last_refuel['distance'] != 0){
            $cost_last_period /= $this->last_refuel['distance'];
            $calculations['Средна цена за разстояние'] = round($cost_last_period, 2);
        }
        else {
            $calculations['Средна цена за разстояние'] = 0;
        }
        $calculations['Най-нисък разход на гориво'] = self::findMinConsumationOfFuel(self::getAllEvents());
        $calculations['Най-ниска цена за разстояние'] = self::findMinCostPerDistance(self::getAllEvents());
 
        $selected = array(
            'gas_station_name' => 'Без значение бензиностанция', // Set your desired gas station name
            'gas_station_product' => 'Без значение марка гориво', // Set your desired gas station product
            'driving_type' => 'Без значение вид на шофиране' // Set your desired driving type
        );
 
        $selectedData = $this->getBySelected($selected);
       
        return $calculations;
    }
    public function setFilteredValues($gasStationName, $gasProduct, $drivingType) {
        $this->filteredGasStationName = $gasStationName;
        $this->filteredGasProduct = $gasProduct;
        $this->filteredDrivingType = $drivingType;
    }
    
    public function getAllEvents() {
        return $this->data['refuel_events'];
    }
    public function getSelectOptions($field) {
        $jsonData = file_get_contents(Events::JSON_FILE); 
        $data = json_decode($jsonData, true);
        $options = array();
 
        foreach ($data['refuel_events'] as $event) {
            if (!empty($event[$field]) && !in_array($event[$field], $options)) {
                $options[] = $event[$field];
            }
        }
 
        return $options;
    }
}