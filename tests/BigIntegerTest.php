<?php

use PHPUnit\Framework\TestCase;

final class BigIntegerTest extends TestCase
{

    public function testAmount()
    {
        $amount = \Krzysztofzylka\Price\BigInteger::of(124, 2);
        $this->assertEquals($amount->toArray(), ['amount' => 124, 'decimal' => 2]);

        $amount = \Krzysztofzylka\Price\BigInteger::of("123.4567", 3);
        $this->assertEquals($amount->toArray(), ['amount' => 123456, 'decimal' => 3]);

        $amount = \Krzysztofzylka\Price\BigInteger::of(124.44, 3);
        $this->assertEquals($amount->toArray(), ['amount' => 12444, 'decimal' => 3]);

        $amount = \Krzysztofzylka\Price\BigInteger::of(\Krzysztofzylka\Price\BigInteger::of(12342423, 6), 3);
        $this->assertEquals($amount->toArray(), ['amount' => 12342, 'decimal' => 3]);

        var_dump((string)\Krzysztofzylka\Price\BigInteger::of(12342423, 6));
    }

}