<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function index()
    {
        $incomes = Income::all();
        return view('incomes.index', compact('incomes'));
    }

    public function create()
    {
        return view('incomes.create');
    }

    public function store(Request $request)
    {
        $income = new Income();
        $income->description = $request->description;
        $income->amount = $request->amount;
        $income->date = $request->date;
        $income->save();

        return redirect()->route('incomes.index');
    }
}
