<?php

namespace Krzysztofzylka\Price;

use Brick\Math\BigDecimal;
use Brick\Math\BigNumber;
use Brick\Math\Exception\DivisionByZeroException;
use Brick\Math\Exception\MathException;
use Brick\Math\Exception\NumberFormatException;
use Brick\Math\RoundingMode;

class Price
{

    /**
     * Global default currency
     * @var string|null
     */
    public static ?string $currency = null;

    /**
     * Amount
     * @var BigDecimal
     */
    protected BigDecimal $amount;

    /**
     * Create price instance
     * @param Price|BigNumber|int|float|string|null $amount
     * @throws DivisionByZeroException
     * @throws NumberFormatException
     */
    protected function __construct(Price|BigNumber|int|float|string|null $amount = 0)
    {
        $this->fixInputAmount($amount);

        $this->amount = BigDecimal::of($amount);
    }

    /**
     * Fix input amount
     * @param $amount
     * @return void
     */
    private function fixInputAmount(&$amount): void
    {
        if (empty($amount)) {
            $amount = 0;
        } elseif ($amount instanceof Price) {
            $amount = $amount->getAmount();
        }
    }

    /**
     * Creates a new Price instance with the given amount.
     * @param Price|BigNumber|int|float|string|null $amount The amount used to create the Price instance.
     * @return Price The newly created Price instance.
     * @throws DivisionByZeroException
     * @throws NumberFormatException
     */
    public static function of(Price|BigNumber|int|float|string|null $amount): Price
    {
        return new Price($amount);
    }

    /**
     * Retrieves the amount of the Price instance.
     * @return float The amount of the Price instance.
     */
    public function getAmount(): float
    {
        return $this->amount->toFloat();
    }

    /**
     * Returns the formatted amount with the given currency.
     * @param string|null $currency The currency code used for formatting the amount. If null, it uses the default currency.
     * @return string The formatted amount with the specified currency.
     */
    public function getFormatAmount(string $currency = null): string
    {
        return number_format(
            $this->getAmount(),
            2,
            ',',
            ' '
        ) . ($currency ? (' ' . $currency) : '');
    }

    /**
     * Adds the specified amount to the current Price instance.
     * @param Price|BigNumber|int|float|string|null $amount The amount to be added to the Price instance.
     * @return self The updated Price instance after the addition.
     * @throws DivisionByZeroException If the division by zero occurs while performing the addition.
     * @throws NumberFormatException|MathException If the amount is not in a valid numeric format.
     */
    public function plus(Price|BigNumber|int|float|string|null $amount): self
    {
        $this->fixInputAmount($amount);
        $this->amount = $this->amount->plus($amount);

        return $this;
    }

    /**
     * Subtracts the given amount from the current Price instance.
     * @param Price|BigNumber|int|float|string|null $amount The amount to subtract from the current Price instance.
     * @return self The current Price instance after subtracting the amount.
     * @throws MathException
     */
    public function minus(Price|BigNumber|int|float|string|null $amount): self
    {
        $this->fixInputAmount($amount);
        $this->amount = $this->amount->minus($amount);

        return $this;
    }

    /**
     * Add tax rate
     * @param int $tax
     * @return Price
     * @throws DivisionByZeroException
     * @throws MathException
     * @throws NumberFormatException
     */
    public function plusTaxRate(int $tax): self
    {
        $taxPrice = BigDecimal::of($this->amount)->multipliedBy(
            BigDecimal::of($tax)->dividedBy(100, 2, RoundingMode::HALF_UP)
        );

        $this->plus($taxPrice);

        return $this;
    }

}