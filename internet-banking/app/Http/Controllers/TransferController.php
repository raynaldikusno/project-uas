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
        $transfer->fromAccount = $request->fromAccount;
        $transfer->toAccount = $request->toAccount;
        $transfer->amount = $request->amount;

        $transfer->save();

        return redirect()->back()->with('success', 'Transfer berhasil disimpan.');
    }

}