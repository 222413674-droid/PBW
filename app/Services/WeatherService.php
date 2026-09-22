<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use RuntimeException;

class WeatherService
{
    public function getCurrent(): array
    {
        $response = Http::timeout(15)->acceptJson()->get('https://api.open-meteo.com/v1/forecast', [
            'latitude' => config('services.weather.latitude'),
            'longitude' => config('services.weather.longitude'),
            'current' => 'temperature_2m,relative_humidity_2m,wind_speed_10m,weather_code',
            'timezone' => 'Asia/Jakarta',
        ]);

        if (!$response->successful()) throw new RuntimeException('Data cuaca tidak tersedia.');
        $data = $response->json();
        if (!isset($data['current'])) throw new RuntimeException('Data current weather tidak ditemukan.');

        return [
            'location' => config('services.weather.location'),
            'temperature' => $data['current']['temperature_2m'] ?? null,
            'temperature_unit' => $data['current_units']['temperature_2m'] ?? '°C',
            'humidity' => $data['current']['relative_humidity_2m'] ?? null,
            'humidity_unit' => $data['current_units']['relative_humidity_2m'] ?? '%',
            'wind' => $data['current']['wind_speed_10m'] ?? null,
            'wind_unit' => $data['current_units']['wind_speed_10m'] ?? 'km/h',
            'weather_code' => $data['current']['weather_code'] ?? null,
            'time' => $data['current']['time'] ?? null,
        ];
    }
}
