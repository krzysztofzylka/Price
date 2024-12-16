<?php

namespace Krzysztofzylka\Price;

/**
 * Class Price
 * Handles the formatting and representation of monetary values.
 */
class Price
{

    /** @var string|null Currency symbol, e.g., 'PLN', 'USD'. */
    private ?string $currency = null;

    /** @var BigInteger The amount in the smallest currency unit (e.g., cents, grosze). */
    private BigInteger $amount;

    /** @var BigInteger The number of decimal places to display. */
    private BigInteger $decimal = 2;

    /**
     * Static price constructor.
     * @param BigInteger $amount The amount in the smallest currency unit.
     * @param string|null $currency Optional currency symbol.
     * @param BigInteger $decimal Optional number of decimal places (default: 2).
     */
    public static function of(BigInteger $amount, ?string $currency = null, BigInteger $decimal = 2): Price
    {
        return new self($amount, $currency, $decimal);
    }

    /**
     * Price constructor.
     * @param BigInteger $amount The amount in the smallest currency unit.
     * @param string|null $currency Optional currency symbol.
     * @param BigInteger $decimal Optional number of decimal places (default: 2).
     */
    public function __construct(BigInteger $amount, ?string $currency = null, BigInteger $decimal = 2)
    {
        $this->amount = $amount;
        $this->decimal = $decimal;
        $this->currency = $currency;
    }

    public function setDecimal(BigInteger $decimal): self
    {
        $this->decimal = $decimal;

        return $this;
    }

    /**
     * Set currency symbol.
     * @param string $currency The currency symbol to set.
     * @return self Returns the current instance for method chaining.
     */
    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get formatted price.
     * Formats the amount based on the specified decimal places and adds the currency symbol if set.
     * @return string The formatted price string.
     */
    public function getFormattedPrice(): string
    {
        $divider = pow(10, $this->decimal);
        $formatted = number_format($this->amount / $divider, $this->decimal, ',', '');

        return $this->currency ? $formatted . ' ' . $this->currency : $formatted;
    }

    /**
     * Convert a string or float amount to the smallest currency unit.
     * @param string|float $value The value to convert (e.g., "123.44", "123,44", 123.44).
     * @return self Returns the current instance for method chaining.
     */
    public function convertToAmount(string|float $value)
    {
        var_dump($value);
        return 123;

//        $floatValue = is_string($value) ? (float) str_replace(',', '.', $value) : $value;
//        $multiplier = pow(10, $this->decimal);
//        $this->amount = (int) floor($floatValue * $multiplier);

//        return $this;
    }

}
