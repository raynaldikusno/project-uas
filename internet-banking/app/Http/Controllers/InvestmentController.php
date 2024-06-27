<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvestmentController extends Controller
{
    public function index()
    {
        // Contoh: Ambil data investasi dari model atau service
        $investments = Investment::all(); // Misalnya Investment adalah model yang ada

        // Tampilkan view dengan data investasi
        return view('investment.index', compact('investments'));
    }
}
