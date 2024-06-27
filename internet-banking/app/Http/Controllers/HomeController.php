<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth; // Pastikan ini diimpor
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('welcome', compact('user'));
    }
   
    // Contoh di HomeController
public function welcome()
{
    $user = Auth::user(); // Mengambil data user yang sedang login

    $user_data = User::find($user->id);

    return view('welcome', compact('user', 'user_data'));
}


    // public function welcome()
    // {
    //     // Fetch transactions from the database
    //     $transactions = Transaction::all();

    //     // Pass the transactions to the view
    //     return view('welcome', compact('transactions'));
    // }
}
