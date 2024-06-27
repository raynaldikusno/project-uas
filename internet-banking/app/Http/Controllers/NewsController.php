<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        // Contoh: Ambil data berita dari model atau service
        $news = News::latest()->paginate(10); // Misalnya News adalah model yang ada

        // Tampilkan view dengan data berita
        return view('news.index', compact('news'));
    }
}
