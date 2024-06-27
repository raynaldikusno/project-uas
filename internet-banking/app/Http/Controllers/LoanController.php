<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index()
    {
        return view('loan.form');
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'loan_amount' => 'required|integer',
            'loan_period' => 'required|integer',
        ]);

        $loanAmount = $request->input('loan_amount');
        $loanPeriod = $request->input('loan_period');
        $interestRate = 0.05;
        $totalPayable = $loanAmount + ($loanAmount * $interestRate * ($loanPeriod / 12));

        return redirect()->route('loan.result', [
            'name' => $request->input('name'),
            'account_number' => $request->input('account_number'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'loan_amount' => $loanAmount,
            'loan_duration' => $loanPeriod,
            'total_payable' => $totalPayable,
        ]);
    }

    public function showResult(request $request)
    {
        $data = $request->only(['name', 'account_number','phone', 'address', 'loan_amount', 'loan_duration', 'total_payable']);

        return view('loan.result', $data);
    }
}
