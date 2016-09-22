<?php
require_once("class/Transport.class.php");

$cargoTransport = new cargoTransport("Грузовой", "60", "1999", "D", "20000");
echo $cargoTransport->getInfo();
echo '<hr>';
$passengerTransport = new passengerTransport("Пассажирский", "80", "1959", "F", "54");
echo $passengerTransport->getInfo();
echo '<hr>';
$automobileTransport = new automobileTransport("Легковой", "110", "2000", "B", "2");
echo $automobileTransport->getInfo();
echo '<hr>';
$motorcycleTransport = new motorcycleTransport("Двухколесный", "200", "2004", "А", "1");
echo $motorcycleTransport->getInfo();
echo '<hr>';
$yachtTransport = new yachtTransport("Судоходный", "127", "2011", "R", "2");
echo $yachtTransport->getInfo();
echo '<hr>';
?>