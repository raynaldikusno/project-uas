<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BalanceController extends Controller
{
    public function index()
    {
        $balances = Balance::all();
        return view('balances.index', compact('balances'));
    }

    public function create()
    {
        return view('balances.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'amount' => 'required|numeric',
            'type' => 'required|in:income,expense',
            'date' => 'required|date',
        ]);

        Balance::create($request->all());

        return redirect()->route('balances.index');
    }

    public function monthlyReport()
    {
        $currentMonth = Carbon::now()->month;
        $incomes = Balance::where('type', 'income')
                          ->whereMonth('date', $currentMonth)
                          ->get();
        $expenses = Balance::where('type', 'expense')
                           ->whereMonth('date', $currentMonth)
                           ->get();

        $totalIncome = $incomes->sum('amount');
        $totalExpense = $expenses->sum('amount');

        return view('balances.monthly_report', compact('incomes', 'expenses', 'totalIncome', 'totalExpense'));
    }
}
