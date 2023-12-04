<?php

namespace Krzysztofzylka\Price;

class Calculate
{

    /**
     * Format amount
     * @param float $amount
     * @param string $currency
     * @return string
     */
    public static function formatAmount(float $amount, string $currency = 'PLN') : string {
        return number_format($amount, 2, ',', ' ') . ($currency ? (' ' . $currency) : '');
    }

    /**
     * Calculate VAT amount
     * @param float $amount
     * @param float $vat
     * @return float
     */
    public static function calculateVatAmount(float $amount, float $vat) : float {
        return $amount * ($vat / 100);
    }

    /**
     * Calculate net amount
     * @param float $grossAmount
     * @param float $vatRate
     * @return float
     */
    public static function calculateNetAmount(float $grossAmount, float $vatRate) : float {
        return $grossAmount / (1 + ($vatRate / 100));
    }

    /**
     * Calculate gross amount
     * @param float $netAmount
     * @param float $vatRate
     * @return float
     */
    public static function calculateGrossAmount(float $netAmount, float $vatRate) : float {
        return $netAmount * (1 + ($vatRate / 100));
    }

}