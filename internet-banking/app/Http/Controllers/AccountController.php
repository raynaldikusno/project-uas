<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;


class AccountController extends Controller
{
    public function index()
    {
        $accountDetails = [
            'account_number' => '1234567890',
            'balance' => 5000.00,
        ];

        return view('accounts.index', compact('accountDetails'));
    }
}

