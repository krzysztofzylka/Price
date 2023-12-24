<?php

namespace Krzysztofzylka\Price\Math;

class Math
{

    public static int $scale = 2;

    /**
     * Add
     * @param $a
     * @param $b
     * @return mixed
     */
    public static function add($a, $b)
    {
        if (extension_loaded('bcmath')) {
            return bcadd($a, $b, self::$scale);
        }

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
        if (extension_loaded('bcmath')) {
            return bcsub($a, $b, self::$scale);
        }

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
        if (extension_loaded('bcmath')) {
            return bcmul($a, $b, self::$scale);
        }

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
        if (extension_loaded('bcmath')) {
            return bcdiv($a, $b, self::$scale);
        }

        return $a / $b;
    }

}