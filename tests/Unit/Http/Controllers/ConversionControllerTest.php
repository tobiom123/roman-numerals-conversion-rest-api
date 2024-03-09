<?php

namespace Tests\Unit\Http\Controllers;

use App\Models\Conversion;
use App\Services\ConversionService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery\MockInterface;
use Tests\TestCase;

class ConversionControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_all_conversion_can_be_listed(): void
    {
        $conversionCount = 5;
        Conversion::factory()->count($conversionCount)->create();

        $this->assertDatabaseCount('conversions', $conversionCount);

        $response = $this->get('/api/conversions');
        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'integer_value',
                        'roman_numeral',
                        'created_at',
                        'updated_at'
                    ],
                ],
            ]);
    }

    public function test_new_conversions_can_be_stored(): void
    {
        $this->assertDatabaseEmpty('conversions');

        $number = 10;
        $response = $this->post('/api/conversions', ['number' => $number]);
        $response->assertStatus(201)
            ->assertJson([
                'data' => [
                    'integer_value' => $number,
                    'roman_numeral' => 'X'
                ]
            ]);

        $this->assertDatabaseHas('conversions', [
            'integer_value' => $number,
            'roman_numeral' => 'X'
        ]);
    }

    public function test_store_method_calls_converter_service_to_convert_integer_into_roman_numeral()
    {
        $number = 8;
        $conversionServiceMock = Mock(ConversionService::class, function (MockInterface $mock) use ($number) {
            $mock->shouldReceive('convertToRomanNumeral')
                ->once()->with($number)->andReturn('VIII');
        });
        $this->app->instance(ConversionService::class, $conversionServiceMock);
        $this->post('/api/conversions', ['number' => $number]);
    }

    public function test_no_more_than_ten_most_frequently_converted_integers_are_retrieved()
    {
        for ($i = 0; $i < 15; $i++) {
            Conversion::factory()->count(5)->create(['integer_value' => $i]);
        }

        $response = $this->get('/api/conversions/top-ten');
        $response->assertStatus(200)
            ->assertJsonCount(10, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'integer_value',
                        'conversion_count',
                        'last_converted_at',
                    ],
                ],
            ]);
    }

    public function test_conversions_are_ordered_by_frequency_and_latest_date(): void
    {
        Conversion::factory()->count(3)->create(['integer_value' => 1, 'created_at' => now()->subDay()]);
        Conversion::factory()->count(3)->create(['integer_value' => 2, 'created_at' => now()->subHours(2)]);
        Conversion::factory()->count(3)->create(['integer_value' => 3, 'created_at' => now()]);
        Conversion::factory()->count(2)->create(['integer_value' => 4, 'created_at' => now()->subDay()]);
        Conversion::factory()->count(2)->create(['integer_value' => 5, 'created_at' => now()->subHours(2)]);
        Conversion::factory()->count(2)->create(['integer_value' => 6, 'created_at' => now()]);

        $response = $this->get('/api/conversions/top-ten');
        $response->assertJsonPath('data.0.integer_value', 3)->assertJsonPath('data.0.conversion_count', 3);
        $response->assertJsonPath('data.3.integer_value', 6)->assertJsonPath('data.3.conversion_count', 2);
    }

}
