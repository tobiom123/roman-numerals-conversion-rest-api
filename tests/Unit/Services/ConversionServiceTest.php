<?php

namespace Tests\Unit\Services;

use App\Services\ConversionService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;

class ConversionServiceTest extends \Tests\TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->conversionService = new ConversionService();
    }

    #[DataProvider('integerToExpectedRomanNumeralDataProvider')]
    public function test_can_convert_to_roman_numeral_from_integer_correctly($number, $expectedRomanNumeral)
    {
        $this->assertEquals($expectedRomanNumeral, $this->conversionService->convertToRomanNumeral($number));
    }

    public static function integerToExpectedRomanNumeralDataProvider(): array
    {
        return [
            [3999, 'MMMCMXCIX'],
            [3888, 'MMMDCCCLXXXVIII'],
            [3000, 'MMM'],
            [2345, 'MMCCCXLV'],
            [2023, 'MMXXIII'],
            [1824, 'MDCCCXXIV'],
            [1600, 'MDC'],
            [1453, 'MCDLIII'],
            [1290, 'MCCXC'],
            [1024, 'MXXIV'],
            [1000, 'M'],
            [900, 'CM'],
            [721, 'DCCXXI'],
            [500, 'D'],
            [468, 'CDLXVIII'],
            [400, 'CD'],
            [242, 'CCXLII'],
            [157, 'CLVII'],
            [100, 'C'],
            [90, 'XC'],
            [50, 'L'],
            [40, 'XL'],
            [10, 'X'],
            [9, 'IX'],
            [5, 'V'],
            [4, 'IV'],
            [1, 'I']
        ];
    }
}
