<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use RuntimeException;

class BpsService
{
    private string $baseUrl = 'https://webapi.bps.go.id/v1/api';
    private string $domain;
    private string $key;

    public function __construct()
    {
        $this->domain = trim((string) config('services.BPS.domain'));
        $this->key = trim((string) (
            config('services.BPS.api_key') ?: config('services.BPS.app_id')
        ));
    }

    private function ensureConfigured(): void
    {
        if ($this->key === '') {
            throw new RuntimeException('BPS_API_KEY/BPS_APP_ID belum diisi di file .env.');
        }
    }

    private function get(string $url, array $query = []): array
    {
        $this->ensureConfigured();

        $response = Http::timeout(20)
            ->acceptJson()
            ->get($url, $query);

        if (!$response->successful()) {
            throw new RuntimeException(
                'BPS WebAPI mengembalikan HTTP '.$response->status().'.'
            );
        }

        $json = $response->json();

        if (!is_array($json)) {
            throw new RuntimeException('Response BPS bukan JSON yang valid.');
        }

        return $json;
    }

    private function yearCode(int $year): int
    {
        return $year - 1900;
    }

    public function getVariables(): array
    {
        $url = $this->baseUrl.'/list/model/var/domain/'
            .rawurlencode($this->domain)
            .'/key/'.rawurlencode($this->key);

        $response = $this->get($url);
        $rows = [];

        if (isset($response['data'][1]) && is_array($response['data'][1])) {
            $rows = $response['data'][1];
        }

        return array_values(array_filter($rows, 'is_array'));
    }

    public function findVariable(string $envKey, array $keywords): ?string
    {
        $configured = trim(
            (string) config('services.BPS.indicators.'.$envKey)
        );

        if ($configured !== '') {
            return $configured;
        }

        $best = null;
        $bestScore = 0;

        foreach ($this->getVariables() as $variable) {
            $title = strtolower(
                strip_tags(
                    (string)($variable['title'] ?? $variable['label'] ?? '')
                )
            );

            $id = $variable['var_id']
                ?? $variable['val']
                ?? $variable['id']
                ?? null;

            if ($title === '' || $id === null) {
                continue;
            }

            $score = 0;

            foreach ($keywords as $keyword) {
                $keyword = strtolower(trim($keyword));

                if ($keyword === '') {
                    continue;
                }

                if ($title === $keyword) {
                    $score += 100;
                } elseif (str_contains($title, $keyword)) {
                    $score += strlen($keyword);
                }
            }

            if ($score > $bestScore) {
                $bestScore = $score;
                $best = (string) $id;
            }
        }

        return $best;
    }

    public function getDataByYear(
        string $varId,
        int $year,
        string $vervar = '25'
    ): array {
        $url = $this->baseUrl.'/list/model/data/lang/ind/domain/'
            .rawurlencode($this->domain)
            .'/var/'.rawurlencode($varId)
            .'/vervar/'.rawurlencode($vervar)
            .'/th/'.$this->yearCode($year)
            .'/key/'.rawurlencode($this->key);

        return $this->get($url);
    }

    private function firstNumeric(array $response): ?float
    {
        foreach (($response['datacontent'] ?? []) as $value) {
            if (is_numeric($value)) {
                return (float) $value;
            }
        }

        return null;
    }

    private function indicator(
        string $label,
        string $unit,
        string $envKey,
        array $keywords,
        int $startYear = 2025
    ): array {
        $varId = $this->findVariable($envKey, $keywords);

        if (!$varId) {
            throw new RuntimeException(
                "Variabel BPS untuk {$label} tidak ditemukan."
            );
        }

        for ($year = (int) date('Y'); $year >= $startYear; $year--) {
            try {
                $value = $this->firstNumeric(
                    $this->getDataByYear($varId, $year)
                );

                if ($value !== null) {
                    return [
                        'label' => $label,
                        'unit' => $unit,
                        'var_id' => $varId,
                        'latest' => [
                            'year' => (string)$year,
                            'value' => $value
                        ],
                        'series' => [[
                            'year' => (string)$year,
                            'value' => $value
                        ]],
                    ];
                }
            } catch (\Throwable) {
                continue;
            }
        }

        throw new RuntimeException(
            "Data {$label} BPS tidak ditemukan."
        );
    }

    public function getDashboard(): array
    {
        $definitions = [
            'BPS_POPULATION_VAR' => [
                'Jumlah Penduduk',
                'orang',
                ['jumlah penduduk', 'penduduk'],
                2015
            ],
            'BPS_ECONOMIC_GROWTH_VAR' => [
                'Pertumbuhan Ekonomi',
                '%',
                ['laju pertumbuhan ekonomi', 'pertumbuhan ekonomi'],
                2015
            ],
            'BPS_UNEMPLOYMENT_VAR' => [
                'Tingkat Pengangguran',
                '%',
                ['tingkat pengangguran terbuka', 'pengangguran terbuka'],
                2015
            ],
            'BPS_POVERTY_VAR' => [
                'Kemiskinan',
                '%',
                ['persentase penduduk miskin', 'penduduk miskin', 'kemiskinan'],
                2015
            ],
        ];

        $result = [];

        foreach ($definitions as $key => [$label, $unit, $keywords, $start]) {
            try {
                $result[$key] = $this->indicator(
                    $label,
                    $unit,
                    $key,
                    $keywords,
                    $start
                );
            } catch (\Throwable $e) {
                $result[$key] = [
                    'label' => $label,
                    'unit' => $unit,
                    'error' => $e->getMessage()
                ];
            }
        }

        return $result;
    }

    public function getInfographics(): array
    {
        $domain = config('services.BPS.infographic_domain')
            ?: $this->domain;

        $url = $this->baseUrl
            .'/list/model/infographic/lang/ind/domain/'
            .rawurlencode($domain)
            .'/key/'.rawurlencode($this->key);

        $response = $this->get($url);

        $rows = $response['data'][1] ?? [];

        if (!is_array($rows)) {
            return [];
        }

        return array_map(static function(array $row): array {
            $id = $row['inf_id'] ?? $row['id'] ?? null;

            return [
                'inf_id' => $id,
                'id' => $id,
                'title' => trim(
                    strip_tags(
                        (string)($row['title'] ?? 'Infografis BPS')
                    )
                ),
                'image' => $row['img'] ?? '',
                'date' => $row['date'] ?? '',
                'description' => trim(
                    strip_tags(
                        (string)($row['desc'] ?? '')
                    )
                ),
                'download' => $row['dl'] ?? '',
            ];
        }, array_values(array_filter($rows, 'is_array')));
    }
}