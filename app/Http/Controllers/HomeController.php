<?php

namespace App\Http\Controllers;

use App\Models\Publikasi;

class HomeController extends Controller
{
    public function index()
    {
        $recentPublications = Publikasi::query()
            ->latest('tanggal_rilis')
            ->latest('no')
            ->limit(3)
            ->get();

        return view('home.index', compact('recentPublications'));
    }
}
