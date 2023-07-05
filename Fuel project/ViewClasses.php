<?php

require_once 'Events.php';

interface ViewsHTML {
    public function printHTML($events, $key = NULL);
}

class ViewFirstPage implements ViewsHTML {
    private $header = <<< HEADER
    <html>
    <head>
    <meta charset="UTF-8">
    </head>
    <body>
    HEADER;
    
    private $footer = <<< FOOTER
    </body>
    </html>
    FOOTER;
    public function printHTML($events, $key=NULL)
    {
        $events = $events->getAllEvents();
        $html_code = $this->header;

        $html_code .= <<< HTML
        <section id="menu">
            <a href="index.php"><b>Зареждане</b></a> | <a href="index2.php">Справка</a>
        </section>
        <hr/>
        <section id="refuel">
        <td><form method="POST">
            <button type="submit" name="addEvent" value="addEvent" >Добави</button></form></td>
            <table border="1">
                <tr>
                    <th>Дата</th>
                    <th>Изминато разстояние</th>
                    <th>Общи километри</th>
                    <th>Заредени литри</th>
                    <th>Цена на литър</th>
                    <th>Обща сума</th>
                    <th>Бензиностанция</th>
                    <th>Марка гориво</th>
                    <th>Вид на шофиране</th>
                    <th>Действие</th>
                </tr>

        HTML;
        foreach($events as $key=>$event) {
            if(!isset($event['date'])){
                continue;
            }
            $html_code .= "<tr>\n";
            foreach($event as $param){
                $html_code .=  "<td>$param</td>\n";
            }
            $html_code .=  '<td><form method="POST">
            <button type="submit" name="edit" value="'.$key.'" >Редактирай</button>
            <button type="submit" name="deleteBtn" value="'.$key.'" onclick="return confirm(' . 
            '"Сигурни ли сте че желаете да изтриете записа?") === true>Изтрий</button>
            </form></td>';
        }
        $html_code .= <<< HTML
            </table>
        </section>
        HTML;
        $html_code .= "\n" . $this->footer;
        return $html_code;
    }
}

class ViewAdd implements ViewsHTML {
    private $header = <<< HEADER
    <html>
    <head>
    <meta charset="UTF-8">
    </head>
    <body>
    HEADER;
    
    private $footer = <<< FOOTER
    </body>
    </html>
    FOOTER;

    public function printHTML($events = NULL, $key=NULL) {
        $html_code = $this->header;
        $html_code = <<< HTML
        <section id="refuel_add">
            <form method="POST">
                <table border="1">
                    <tr>
                        <th>Дата</th>
                        <td><input type="date" name="date" placeholder="Дата"/></th>
                    </tr>
                    <tr>
                        <th>Изминато разстояние</th>
                        <td><input type="float" name="distance" placeholder="километри"/></th>
                    </tr>
                    <tr>
                        <th>Общо изминато разстояние</th>
                        <td><input type="float" name="total_odo" placeholder="километри" /></th>
                    </tr>
                    <tr>
                        <th>Заредени литри</th>
                        <td><input type="float" name="fuel_quantity" placeholder="литри" /></th>
                    </tr>
                    <tr>
                        <th>Цена на литър</th>
                        <td><input type="float" name="fuel_amount" placeholder="цена" /></th>
                    </tr>
                    <tr>
                        <th>Обща сума</th>
                        <td><input type="float" name="total_price" placeholder="Обща сума" /></th>
                    </tr>
                    <tr>
                        <th>Марка гориво</th>
                        <td><input type="text" name="gas_station_product" placeholder="Марка гориво" /></th>
                    </tr>
                    <tr>
                        <th>Бензиностанция</th>
                        <td><input type="text" name="gas_station_name" placeholder="Бензиностанция" /></th>
                    </tr>
                    <tr>
                        <th>Вид на шофиране</th>
                        <td>
                            <select name="driving_type">
                                <option value="">Без значение</option>
                                <option value="city">Градско</option>
                                <option value="intercity">Извънградско</option>
                                <option value="mixed">Смесено</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="right">
                            <button type="submit" name="add" value="add_new" >Запази</button>
                        </td>
                    </tr>
                </table>
            </form>
        </section>
        HTML;
        $html_code .= $this->footer;
        return $html_code;
    }

}
class ViewEditPage implements ViewsHTML {
    private $header = <<< HEADER
    <html>
    <head>
    <meta charset="UTF-8">
    </head>
    <body>
    HEADER;
    
    private $footer = <<< FOOTER
    </body>
    </html>
    FOOTER;

    public function printHTML($events, $key=NULL) {
        $html_code = $this->header;
        $html_code = <<< HTML
        <section id="refuel_add">
            <form method="POST">
                <table border="1">
                <tr>
                    <th>Дата</th>
                    <td><input type="date" name="date" placeholder="Дата" value="{$events['Дата']}"/></th>
                </tr>
                <tr>
                    <th>Изминато разстояние</th>
                    <td><input type="float" name="distance" placeholder="километри" value="{$events['Изминато разстояние']}"/></th>
                </tr>
                <tr>
                    <th>Общо изминато разстояние</th>
                    <td><input type="float" name="total_odo" placeholder="километри" value="{$events['Общо изминато разстояние']}" /></th>
                </tr>
                <tr>
                    <th>Заредени литри</th>
                    <td><input type="float" name="fuel_quantity" placeholder="литри" value="{$events['Заредени литри']}" /></th>
                </tr>
                <tr>
                    <th>Цена на литър</th>
                    <td><input type="float" name="fuel_amount" placeholder="цена" value="{$events['Цена на литър']}" /></th>
                </tr>
                <tr>
                    <th>Обща сума</th>
                    <td><input type="float" name="total_price" placeholder="Обща сума" value="{$events['Обща сума']}" /></th>
                </tr>
                <tr>
                    <th>Марка гориво</th>
                    <td><input type="text" name="gas_station_product" placeholder="Марка гориво" value="{$events['Марка гориво']}" /></th>
                </tr>
                <tr>
                    <th>Бензиностанция</th>
                    <td><input type="text" name="gas_station_name" placeholder="Бензиностанция" value="{$events['Вид на шофиране']}" /></th>
                </tr>
                    <tr>
                        <th>Вид на шофиране</th>
                        <td>
                            <select name="driving_type">
                                <option value="">Без значение</option>
                                <option value="city">Градско</option>
                                <option value="intercity">Извънградско</option>
                                <option value="mixed">Смесено</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="right">

        HTML;
        $html_code .= '<button type="submit" name="saveEdited" value="'.$key.'" >Запази</button>';
        $html_code .= <<< HTML
         
                        </td>
                    </tr>
                </table>
            </form>
        </section>
        HTML;
        $html_code .= $this->footer;
        return $html_code;
    }
}