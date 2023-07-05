<?php

require_once 'Events.php';

class Views1 {
    private $header = <<< HEADER
    <html>
    <head>
    <meta charset="UTF-8">
    </head>
    <body>
    HEADER;

    private $footer = <<< FOOTER
    </table>
    </section>
    </body>
    </html>
    FOOTER;

    public function printReportPage($events, $defaultValueGasStation, $defaultValueGasProduct, $defaultValueDrivingType) {
        $table = $events->Table1();
        $metrics = array(
            'Изминато разстояние' => '[километри]',
            'Разход на гориво' => '[литри / 100 километра]',
            'Цена за разстояние' => '[лева / километър]'
        );

        $html_code = $this->header;
        $html_code .= <<< HTML
        <section id="menu">
            <a href="index.php">Зареждане</a> | <a href="index2.php"><b>Справка</b></a>
        </section>
        <section id="report_last_period">
            <h3>Справка за последен период на зареждане</h3>
            <table>
        HTML;

        foreach ($table as $key => $value) {
            $html_code .= "<tr>\n" . "<th>$key</th>\n" . "<td>$value $metrics[$key]</td>\n" . "</tr>\n";
        }

        $html_code .= <<< HTML
            </table>
        </section>
        <hr/>
        <section id="report_averages">
            <h3>Справка средни стойности</h3>
            <table>
        HTML;

        $table = $events->Table2();
        foreach ($table as $key => $value) {
            $html_code .= "<tr>\n" . "<th>$key</th>\n" . "<td>$value</td>\n" . "</tr>\n";
        }

        $html_code .= <<< HTML
            </table> 
        </section>
        <hr/>
        <section id="report-best-option">
            <h3>Справка най-добра опция</h3>
            <form method="POST">
                <select name="gas_station_name">
                    <option value="">Без значение бензиностанция</option>
                    {$this->getDropdownOptions($events->getSelectOptions('gas_station_name'), $defaultValueGasStation)}
                </select>
                <select name="gas_station_product">
                    <option value="">Без значение марка гориво</option>
                    {$this->getDropdownOptions($events->getSelectOptions('gas_station_product'), $defaultValueGasProduct)}
                </select>
                <select name="driving_type">
                    <option value="">Без значение вид на шофиране</option>
                    {$this->getDropdownOptions($events->getSelectOptions('driving_type'), $defaultValueDrivingType)}
                </select>
                <input type="submit" name="reportBtn" value="Преизчисли" />
            </form>
            <table>
        HTML;

        $table = $events->Table3();
        $metrics = array('Среден разход на гориво'=>'[литри/100 километра]', 'Средна цена за разстояние'=>'[лева/километър]',
                        'Най-нисък разход на гориво'=>'[литри/100 километра]', 'Най-ниска цена за разстояние'=>'[лева/километър]');
            
                foreach($table as $key => $value) {
                $html_code .= <<< HTML
                <tr>
                    <th>$key</th>
                    <td>$value $metrics[$key]</td>
                </tr>
                HTML;
                }
            
                $html_code .= $this->footer;
                return $html_code;
    }
    private function getDropdownOptions($options, $defaultValue) {
        $dropdownOptions = '';

        foreach ($options as $option) {
            $selected = ($option === $defaultValue) ? 'selected' : '';
            $dropdownOptions .= '<option value="' . htmlspecialchars($option) . '" ' . $selected . '>' . htmlspecialchars($option) . '</option>';
        }

        return $dropdownOptions;
    }
}

class Control1 {
    private $event;
    private $view;

    public function __construct()
    {
        $this->event = new Events;
        $this->view = new Views1;
        $this->jsonFilePath = 'datafile.json';
    }

    public function print() {
        $gasStationDefault = $_POST['gas_station_name'] ?? 'Без значение бензиностанция';
        $gasProductDefault = $_POST['gas_station_product'] ?? 'Без значение марка гориво';
        $drivingTypeDefault = $_POST['driving_type'] ?? 'Без значение вид на шофиране';
    
        // Set filtered values for table calculations
        $this->event->setFilteredValues($gasStationDefault, $gasProductDefault, $drivingTypeDefault);
    
        echo $this->view->printReportPage($this->event, $gasStationDefault, $gasProductDefault, $drivingTypeDefault);
    }
   
}

$control = new Control1;
$control->print();