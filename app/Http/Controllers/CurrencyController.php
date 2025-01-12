<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class CurrencyController extends Controller
{
    public function fetchRates()
    {
        $apiKey = env('EXCHANGE_API_KEY'); // Store your API key in .env
        $url = "https://api.exchangerate-api.com/v4/latest/USD"; // Example API endpoint

        $response = Http::get($url);

        if ($response->successful()) {
            return $response->json();
        }

        return response()->json(['error' => 'Unable to fetch exchange rates'], 500);
    }
}
