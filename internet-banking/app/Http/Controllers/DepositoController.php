<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deposito;
use Illuminate\Support\Facades\DB;

class DepositoController extends Controller
{
    public function openDepositAccount(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'duration' => 'required|in:2,4,24,168',
        ]);

        $user = auth()->user();
        $interestRate = 1; // 1% per jam
        $startTime = time(); // Waktu saat ini dalam UNIX timestamp
        $endTime = $startTime + ($validated['duration'] * 3600); // Menambahkan durasi dalam jam ke waktu saat ini
        $amount = $request->input('amount');

        $deposits = Deposito::create([
            'user_id' => $user->id,
            'amount' => $validated['amount'],
            'interest_rate' => $interestRate,
            'duration' => $validated['duration'],
            'start_time' => date('Y-m-d H:i:s', $startTime),
            'end_time' => date('Y-m-d H:i:s', $endTime),
        ]);
        $user->balance -= $amount;
        $user->save();

        return redirect()->back()->with('success', 'Deposit berhasil dibuka.');
    }

    public function transferMaturedDeposits()
    {
        $now = time(); // Waktu saat ini dalam UNIX timestamp
        $maturedDeposits = Deposito::where('end_time', '<=', date('Y-m-d H:i:s', $now))
                                  ->where('transferred', false)
                                  ->get();

        foreach ($maturedDeposits as $deposit) {
            DB::transaction(function () use ($deposit, $now) {
                $user = $deposit->user;
                $interest = ($deposit->amount * $deposit->interest_rate / 100) * ($deposit->duration);

                $totalAmount = $deposit->amount + $interest;
                $user->balance += $totalAmount;
                $user->save();

                $deposit->transferred = true;
                $deposit->save();
            });
        }

        return response()->json(['message' => 'Matured deposits transferred successfully']);
    }

    public function depositInfo()
    {
        $user = auth()->user();
        $deposits = $user->deposits;

        return response()->json(['deposits' => $deposits]);
    }
}
