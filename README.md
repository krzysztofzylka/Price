# Install
```bash
composer require krzysztofzylka/price
```

# Methods
## Price
### Global default currency
```php
\Krzysztofzylka\Price\Price::$currency = NULL;
```
### Initialize
Initialize with 50.00
```php
$price = \Krzysztofzylka\Price\Price::of(50)
```
### Add tax rate
Add 23% tax rate
```php
$price->plusTaxRate(23);
```
### Add price
Add 150.00 price
```php
$price->plus(150);
```
### Subtract price
Subtract 100 price
```php
$price->minus(100);
```
### Get amount
```php
echo $price->getAmount();
//173
```
### Get format amount
```php
echo $price->getFormatAmount('EUR');
//173,00 EUR
```
## Calculate
### Format amount
```php
\Krzysztofzylka\Price\Calculate::formatAmount(100, 'PLN');
// 100,00 PLN
```
### Calculate vat amount
```php
\Krzysztofzylka\Price\Calculate::calculateVatAmount($amount, $vat)
```
### Calculate net amount
```php
\Krzysztofzylka\Price\Calculate::calculateNetAmount($grossAmount, $vatRate)
```
### Calculate gross amount
```php
\Krzysztofzylka\Price\Calculate::calculateGrossAmount($netAmount, $vatRate)
```