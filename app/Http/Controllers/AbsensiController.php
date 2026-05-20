<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class AbsensiController extends Controller
{
    public function index()
{
    $response = Http::withoutVerifying()
        ->get('https://script.google.com/macros/s/AKfycbyc5cQZ48jjnXILg1NsPc6qXPoR4VXT9w5746KniKdZgJbXtUsKUbcs-jS8uaJRVnMt/exec?mode=api');

    $data = json_decode($response->body(), true);

    if (!is_array($data)) {
        $data = [];
    }

    return view('admin.dashboard', compact('data'));
}
}
