<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function showProfile(): View
    {
        $user = Auth::user();
        dd($user); // Debugging statement
        return view('profile', compact('user'));
    }

    public function showTransactions()
    {
        $user = Auth::user();
        $transactions = $user->transactions; // Assuming a relationship is defined
        return view('transactions', compact('user', 'transactions'));
    }
    public function edit(Request $request): View
    {
        return view('profile.edit', ['user' => Auth::user()]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:15',
            'profile_image' => 'required|string'
        ]);

        $user = $request->user();
        $user->fill($validated);
        $user->phone = $request->phone;

        if ($request->user()->isDirty('email')) {
            $user->email_verified_at = null;
        }

        if ($request->has('profile')) {
            $user->profile = $request->input('profile');
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        // Validate input
        $request->validate([
            'action' => 'required|in:topup,withdraw',
            'amount' => 'required|numeric|min:0',
        ]);

        // Perform action based on 'action' parameter
        if ($request->action == 'topup') {
            // Top-up balance
            $user->balance += $request->amount;
            $user->save();

            return redirect()->back()->with('success', 'Balance topped up successfully!');
        } elseif ($request->action == 'withdraw') {
            // Check if sufficient balance
            if ($request->amount > $user->balance) {
                return redirect()->back()->with('error', 'Insufficient balance!');
            }

            // Withdraw balance
            $user->balance -= $request->amount;
            $user->save();

            return redirect()->back()->with('success', 'Balance withdrawn successfully!');
        }

        // If 'action' is neither topup nor withdraw
        return redirect()->back()->with('error', 'Invalid action!');
    }
    public function topup(Request $request)
    {
        $user = Auth::user();

        // Validate input amount
        $request->validate([
            'amount' => 'required|numeric|min:0',
        ]);

        // Add to user's balance
        $user->balance += $request->amount;
        $user->save();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Balance topped up successfully!');
    }
}

