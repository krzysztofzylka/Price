<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('../vendor/autoload.php');
$price = new \Krzysztofzylka\Price\Price(100);
$price->addTaxRate(23);
$price->addPrice(20.54);

echo '<pre>';
var_dump(
    $price,
    $price->getAmount(),
    $price->getFormatAmount(),
    $price->getFormatAmount('PLN')
);