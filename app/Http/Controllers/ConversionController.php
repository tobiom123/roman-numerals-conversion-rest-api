<?php

namespace App\Http\Controllers;

use App\Http\Resources\ConversionResource;
use App\Http\Resources\ConversionResourceCollection;
use App\Models\Conversion;
use App\Services\ConversionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConversionController extends Controller
{
    protected ConversionService $conversionService;
    public function __construct(ConversionService $conversionService)
    {
        $this->conversionService = $conversionService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new ConversionResourceCollection(Conversion::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'number' => 'required|integer|min:1|max:3999',
        ]);
        $number = $validated['number'];

        $romanNumeral = $this->conversionService->convertToRomanNumeral($number);

        $conversion = new Conversion();
        $conversion->integer_value = $number;
        $conversion->roman_numeral = $romanNumeral;
        $conversion->save();

        return new ConversionResource($conversion);
    }

    public function mostFrequentlyConvertedIntegers()
    {
        $topTenConvertedIntegers = DB::table('conversions')
            ->select(
                'integer_value',
                DB::raw('count(*) as conversion_count'),
                DB::raw('max(created_at) as last_converted_at')
            )
            ->groupBy('integer_value')
            ->orderByDesc('conversion_count')
            ->orderByDesc('last_converted_at')
            ->take(10)
            //->pluck('integer_value');
            ->get();

        return response()->json([
            'data' => $topTenConvertedIntegers
            ]);
    }
}
