<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Import User model
use App\Models\Transfer; // Import Transfer model

class TransferController extends Controller
{
    public function create()
    {
        return view('transfers.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'fromAccount' => 'required',
            'toAccount' => 'required',
            'amount' => 'required|numeric|min:0.01', // Assuming minimum transfer amount is 0.01
        ]);

        // Retrieve the authenticated user
        $user = auth()->user();

        // Find the recipient user based on account number
        $recipient = User::where('account_number', $request->input('toAccount'))->first();

        if (!$recipient) {
            return redirect()->back()->with('error', 'Penerima dengan nomor rekening tersebut tidak ditemukan.');
        }

        // Check if the user has sufficient balance
        $amount = $request->input('amount');
        if ($user->balance < $amount) {
            return redirect()->back()->with('error', 'Saldo tidak mencukupi untuk melakukan transfer.');
        }

        // Start a database transaction to ensure data consistency
        \DB::beginTransaction();

        try {
            // Update recipient's balance
            $recipient->balance += $amount;
            $recipient->save();

            // Deduct amount from sender's balance
            $user->balance -= $amount;
            $user->save();

            // Record the transfer in transfers table
            $transfer = new Transfer();
            $transfer->from_account = $request->input('fromAccount');
            $transfer->to_account = $request->input('toAccount');
            $transfer->amount = $amount;
            $transfer->save();

            \DB::commit(); // Commit the transaction

            return redirect()->back()->with('success', 'Transfer berhasil disimpan.');
        } catch (\Exception $e) {
            \DB::rollback(); // Rollback the transaction if an exception occurs

            return redirect()->back()->with('error', 'Gagal melakukan transfer. Silakan coba lagi.');
        }
    }
}
