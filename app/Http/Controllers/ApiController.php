<?php

namespace App\Http\Controllers;

use App\Models\Publikasi;
use App\Services\BpsService;
use App\Services\BmkgService;
use App\Services\WeatherService;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function bps(BpsService $service)
    {
        try { return response()->json(['success' => true, 'data' => $service->getDashboard()]); }
        catch (\Throwable $e) { return response()->json(['success' => false, 'data' => null, 'message' => $e->getMessage()], 503); }
    }

    public function weather(WeatherService $service)
    {
        try { return response()->json(['success' => true, 'data' => $service->getCurrent()]); }
        catch (\Throwable $e) { return response()->json(['success' => false, 'data' => null, 'message' => 'Data cuaca sementara tidak tersedia.'], 502); }
    }

    public function earthquake(BmkgService $service)
    {
        try { return response()->json(['success' => true, 'data' => $service->getLatestEarthquake()]); }
        catch (\Throwable $e) { return response()->json(['success' => false, 'data' => null, 'message' => 'Informasi gempa sementara tidak tersedia.'], 502); }
    }

    public function infographics(BpsService $service)
    {
        try { return response()->json(['success' => true, 'data' => array_slice($service->getInfographics(), 0, 6)]); }
        catch (\Throwable $e) { return response()->json(['success' => false, 'data' => [], 'message' => $e->getMessage()], 503); }
    }

    public function publications(Request $request)
    {
        $keyword = trim((string) $request->query('keyword', ''));
        $items = Publikasi::query()
            ->when($keyword !== '', fn($q) => $q->where('judul', 'like', "%{$keyword}%"))
            ->latest('tanggal_rilis')->latest('no')->limit(50)->get();

        return response()->json(['success' => true, 'data' => $items]);
    }
}
