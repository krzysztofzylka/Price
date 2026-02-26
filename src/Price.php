<?php

namespace Krzysztofzylka\Price;

use Brick\Math\BigDecimal;
use Brick\Math\BigNumber;
use Brick\Math\Exception\DivisionByZeroException;
use Brick\Math\Exception\MathException;
use Brick\Math\Exception\NumberFormatException;
use Brick\Math\Exception\RoundingNecessaryException;
use Brick\Math\RoundingMode;

class Price
{

    /**
     * Global default currency
     * @var string|null
     */
    protected ?string $currency = null;

    /**
     * Amount
     * @var BigDecimal
     */
    protected BigDecimal $amount;

    /**
     * Create price instance
     * @param Price|BigNumber|int|float|string|null $amount
     * @param string|null $currency
     */
    protected function __construct(Price|BigNumber|int|float|string|null $amount = 0, ?string $currency = null)
    {
        $this->fixInputAmount($amount);
        $this->setCurrency($currency);

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
     * Set currency
     * @param string|null $currency
     * @return void
     */
    public function setCurrency(?string $currency): void
    {
        $this->currency = $currency;
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
    public function getFormatAmount(?string $currency = null): string
    {
        return number_format(
            $this->getAmount(),
            2,
            ',',
            ' '
        ) . (($this->currency ?? $currency) ? (' ' . ($this->currency ?? $currency)) : '');
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

    /**
     * Remove tax rate
     * @param int $tax
     * @return $this
     * @throws DivisionByZeroException
     * @throws MathException
     * @throws NumberFormatException
     * @throws RoundingNecessaryException
     */
    public function minusTaxRate(int $tax): self
    {
        $taxPrice = BigDecimal::of($this->amount)->multipliedBy(
            BigDecimal::of($tax)->dividedBy(100, 2, RoundingMode::HalfUp)
        );

        $this->minus($taxPrice);

        return $this;
    }

    /**
     * Multiply price by multiplier
     *
     * @param int|float|string $multiplier
     * @return self
     * @throws MathException
     * @throws NumberFormatException
     */
    public function multipliedBy(int|float|string $multiplier): self
    {
        $this->amount = $this->amount->multipliedBy($multiplier);

        return $this;
    }

    /**
     * Divide price by divisor
     *
     * @param int|float|string $divisor
     * @param int $scale
     * @return self
     * @throws DivisionByZeroException
     * @throws MathException
     * @throws NumberFormatException
     */
    public function dividedBy(int|float|string $divisor, int $scale = 2): self
    {
        $this->amount = $this->amount->dividedBy(
            $divisor,
            $scale,
            RoundingMode::HalfUp
        );

        return $this;
    }

    /**
     * Check if current price is greater than given price
     */
    public function isGreaterThan(Price|BigNumber|int|float|string|null $price): bool
    {
        $this->fixInputAmount($price);
        return $this->amount->isGreaterThan($price->amount);
    }

    /**
     * Check if current price is less than given price
     * @throws MathException
     */
    public function isLessThan(Price|BigNumber|int|float|string|null $price): bool
    {
        $this->fixInputAmount($price);

        return $this->amount->isLessThan($price->amount);
    }

    /**
     * Check if current price equals given price
     * @throws MathException
     */
    public function isEqualTo(Price|BigNumber|int|float|string|null $price): bool
    {
        $this->fixInputAmount($price);

        return $this->amount->isEqualTo($price->amount);
    }

    /**
     * To string
     * @return string
     */
    public function __toString(): string
    {
        return $this->getFormatAmount();
    }

}