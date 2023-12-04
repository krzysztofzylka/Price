<?php

namespace Krzysztofzylka\Price;

use Krzysztofzylka\Price\Math\Math;

class Price
{

    /**
     * Global default currency
     * @var string|null
     */
    public static ?string $currency = null;

    /**
     * Price
     * @var float
     */
    private float $price = 0;

    /**
     * Create price
     * @param float|int $price
     */
    public function __construct($price = 0)
    {
        $this->addPrice($price);
    }

    /**
     * Add tax rate
     * @param int $tax
     * @return void
     */
    public function addTaxRate(int $tax)
    {
        $taxPrice = Math::multiply($this->price, Math::divide($tax, 100));

        $this->price = Math::add($this->price, $taxPrice);
    }

    /**
     * Add tax rate
     * @param int|float $price
     * @return void
     */
    public function addPrice(float $price)
    {
        $this->price = Math::add($this->price, $price);
    }

    /**
     * Subtract price
     * @param int|float $price
     * @return void
     */
    public function subtractPrice($price)
    {
        $this->price = Math::subtract($this->price, $price);
    }

    /**
     * Get amount
     * @return float
     */
    public function getAmount(): float
    {
        return $this->price;
    }

    /**
     * Get amount
     * @param string|null $currency
     * @return string
     */
    public function getFormatAmount(string $currency = null): string
    {
        return Calculate::formatAmount($this->price, $currency ?? self::$currency ?? '');
    }

}