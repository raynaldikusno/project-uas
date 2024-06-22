<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Auth;
use App\Models\Transfer; 

class TransferController extends Controller
{
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'fromAccount' => 'required',
            'toAccount' => 'required',
            'amount' => 'required|numeric',
        ]);

        // Simpan data ke dalam database
        $transfer = new Transfer();
        $transfer->from_account  = $request->fromAccount;
        $transfer->to_account  = $request->toAccount;
        $transfer->amount  = $request->amount;

        $transfer->save();

        return redirect()->back()->with('success', 'Transfer berhasil disimpan.');
    }
    public function create()
    {
        return view('transfers.create');
    }

}