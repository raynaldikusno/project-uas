<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Import User model
use App\Models\Transfer; // Import Transfer model

class TransferController extends Controller
{
    public function delete($id)
{
    $transfer = Transfer::findOrFail($id);
    $transfer->delete();

    return response()->json(['message' => 'Transaksi berhasil dihapus.']);
}
    public function deleteTransaction($id)
{
    $transaction = Transaction::findOrFail($id);
    $transaction->delete();

    return response()->json(['message' => 'Transaksi berhasil dihapus.']);
}
    public function getTransferHistory()
    {
        // Ambil data riwayat transfer dari database
        $transfers = Transfer::orderBy('created_at', 'desc')->get(); // Contoh mengambil semua data transfer, diurutkan dari yang terbaru

        // Return data dalam format JSON
        return response()->json($transfers);
    }
//     public function showTransactions()
// {
//     $transfers = Transaction::all(); // Ambil semua data transaksi dari model Transaction

//     return view('transactions.index', [
//         'transfers' => $transfers
//     ]);
// }
    public function showTransactions()
    {
        $transfers = Transfer::all();
        
        // dd($transfers); // Tambahkan ini untuk memeriksa data transfers
    
        return view('transactions', ['transfers' => $transfers]);
    }
    
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


        // if ($validatedData['fromAccount'] !== $user->account_number) {
        //     return redirect()->back()->with('error', 'Anda tidak diizinkan menggunakan nomor rekening ini untuk transfer.');
        // }
        // Find the recipient user based on account number
        $recipient = User::where('account_number', $request->input('toAccount'))->first();
        if (!$recipient) {
        return response()->json(['error' => 'Penerima dengan nomor rekening tersebut tidak ditemukan.'], 404);
        }
        // Check if the recipient account number is different from the sender's account number
    // if ($validatedData['toAccount'] === $user->account_number) {
    //     return redirect()->back()->with('error', 'Anda tidak dapat mentransfer ke akun Anda sendiri.');
    // }

        // Check if the user has sufficient balance
        $amount = $request->input('amount');
        if ($user->balance < $amount) {
        return response()->json(['error' => 'Saldo tidak mencukupi untuk melakukan transfer.'], 403);
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

            // $transfer = new transactions();
            // $transfer->from_account = $request->input('fromAccount');
            // $transfer->to_account = $request->input('toAccount');
            // $transfer->amount = $amount;
            // $transfer->save();

            \DB::commit(); // Commit the transaction

            return redirect()->back()->with('success', 'Transfer berhasil disimpan.');
        } catch (\Exception $e) {
            \DB::rollback(); // Rollback the transaction if an exception occurs

            return redirect()->back()->with('error', 'Gagal melakukan transfer. Silakan coba lagi.');
        }
    }
}
