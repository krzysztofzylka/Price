<?php

namespace Krzysztofzylka\Price;

class BigInteger
{

    /**
     * Amount
     * @var int
     */
    public int $amount;

    /**
     * Decimal
     * @var int
     */
    public int $decimal;

    /**
     * Construct amount instance
     * @param mixed $amount
     * @param int $decimal
     * @return BigInteger
     */
    public static function of(mixed $amount, int $decimal): self
    {
        return new self($amount, $decimal);
    }

    /**
     * Construct amount instance
     * @param mixed $amount
     * @param int $decimal
     */
    public function __construct(mixed $amount, int $decimal)
    {
        $amount = $this->convertAmount($amount, $decimal);

        $this->amount = $amount;
        $this->decimal = $decimal;
    }

    /**
     * Get amount
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * Set amount
     * @param int $amount
     */
    public function setAmount(int $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * Get decimal
     * @return int
     */
    public function getDecimal(): int
    {
        return $this->decimal;
    }

    /**
     * Set decimal
     * @param int $decimal
     */
    public function setDecimal(int $decimal): void
    {
        $this->decimal = $decimal;
    }

    /**
     * Amount to array
     * @return array
     */
    public function toArray(): array
    {
        return [
            'amount' => $this->amount,
            'decimal' => $this->decimal
        ];
    }

    public function __toString(): string
    {
        return (string)substr_replace($this->getAmount(), ',', -$this->decimal, 0);
    }

    /**
     * Convert amount
     * @param mixed $amount
     * @param int $decimal
     * @return int
     */
    protected function convertAmount(mixed $amount, int $decimal): int
    {
        if (is_null($amount)) {
            return 0;
        }

        if ($amount instanceof BigInteger) {
            $amount = (string)$amount;
        }

        if (is_float($amount)) {
            $amount = (string)$amount;
        }

        if (is_string($amount)) {
            $amount = str_replace('.', ',', trim($amount));
            $explode = explode(',', $amount, 2);
            $amount = (int)($explode[0] . substr($explode[1], 0, $decimal));
        }

        return $amount;
    }

}