<?php

namespace Krzysztofzylka\Price\Math;

class Math
{

    /**
     * Add
     * @param $a
     * @param $b
     * @return mixed
     */
    public static function add($a, $b)
    {
        return $a + $b;
    }

    /**
     * Subtract
     * @param $a
     * @param $b
     * @return mixed
     */
    public static function subtract($a, $b)
    {
        return $a - $b;
    }

    /**
     * Multiply
     * @param $a
     * @param $b
     * @return float|int
     */
    public static function multiply($a, $b)
    {
        return $a * $b;
    }

    /**
     * Divide
     * @param $a
     * @param $b
     * @return float|int
     */
    public static function divide($a, $b)
    {
        return $a / $b;
    }

}