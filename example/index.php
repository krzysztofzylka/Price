<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('../vendor/autoload.php');

echo '<pre>';
$price = \Krzysztofzylka\Price\Price::of(50.23);
var_dump($price);
$price->plus(12.77);
$price->minus(10);
//$price->plus(47);
$price->plusTaxRate(23);
var_dump($price->getAmount());
var_dump($price->getFormatAmount('PLN'));

//$price = new \Krzysztofzylka\Price\Price(100);
//$price->addTaxRate(23);
//$price->addPrice(20.54);
//
//echo '<pre>';
//var_dump(a
//    $price,
//    $price->getAmount(),
//    $price->getFormatAmount(),
//    $price->getFormatAmount('PLN')
//);