<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class AbsensiController extends Controller
{
    public function index()
{
    $response = Http::withoutVerifying()
        ->get('https://script.google.com/macros/s/AKfycbwLEkuPdRCRUS33sCfxdobBv2SHLUqPzsN8cY22qy-ooVLjM61UPqdVDklZqfNDCGlz/exec?mode=api');

    $data = json_decode($response->body(), true);

    if (!is_array($data)) {
        $data = [];
    }

    return view('admin.dashboard', compact('data'));
}
}
