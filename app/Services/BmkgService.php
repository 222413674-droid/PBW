<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use RuntimeException;

class BmkgService
{
    public function getLatestEarthquake(): array
    {
        $response = Http::timeout(15)->acceptJson()->get('https://data.bmkg.go.id/DataMKG/TEWS/autogempa.json');
        if (!$response->successful()) throw new RuntimeException('Data gempa BMKG tidak tersedia.');
        $gempa = $response->json('Infogempa.gempa');
        if (!is_array($gempa)) throw new RuntimeException('Data gempa BMKG tidak ditemukan.');

        return [
            'tanggal' => $gempa['Tanggal'] ?? '-',
            'jam' => $gempa['Jam'] ?? '-',
            'magnitude' => $gempa['Magnitude'] ?? '-',
            'kedalaman' => $gempa['Kedalaman'] ?? '-',
            'wilayah' => $gempa['Wilayah'] ?? '-',
            'potensi' => $gempa['Potensi'] ?? '-',
            'dirasakan' => $gempa['Dirasakan'] ?? '-',
            'shakemap' => $gempa['Shakemap'] ?? null,
        ];
    }
}
