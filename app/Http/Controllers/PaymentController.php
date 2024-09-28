<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'debtor_id' => 'required|exists:debtors,id',
            'currency_id' => 'required|exists:currencies,id',
            'amount' => 'required|integer',
        ]);

        // Create payment with authenticated user
        Payment::create([
            'user_id' => Auth::id(),
            'debtor_id' => $request->debtor_id,
            'currency_id' => $request->currency_id,
            'amount' => $request->amount,
        ]);

        return redirect()->back()->with('success', 'Payment added successfully.');
    }
}
