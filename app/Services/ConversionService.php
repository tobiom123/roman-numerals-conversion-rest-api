<?php

namespace App\Services;

class ConversionService
{
    public function convertToRomanNumeral(int $number): string
    {
        $romanNumeral = '';
        $romanNumeralMap = [
            'M' => 1000,
            'CM' => 900,
            'D' => 500,
            'CD' => 400,
            'C' => 100,
            'XC' => 90,
            'L' => 50,
            'XL' => 40,
            'X' => 10,
            'IX' => 9,
            'V' => 5,
            'IV' => 4,
            'I' => 1
        ];

        foreach ($romanNumeralMap as $letter => $value) {
            $amountNeeded = intval($number / $value);
            if ($amountNeeded > 0) {
                $romanNumeral .= str_repeat($letter, $amountNeeded);
                $number -= $amountNeeded * $value;
            }
        }

        return $romanNumeral;
    }
}
