<?php

namespace App\Http\Controllers;

use App\Models\Debtor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DebtorController extends Controller
{
    public function index()
    {
        $userId = Auth::id(); 
        $debtors = Debtor::where('user_id', $userId)->get();
        
        return view('components.debtors', compact('debtors'));
    }
    public function create(Request $request)
    {
        return view('components.add-debtor');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'phone' => 'nullable|string',
            'receipt_date' => 'nullable|date',
            'given_date' => 'nullable|date',
        ]);

        Debtor::create([
            'name' => $request->input('name'),
            'user_id' => Auth::user()->id,
            'address' => $request->input('address'),
            'amount' => $request->input('amount'),
            'phone_number' => $request->input('phone'), // Ensure phone is included if needed
            'date_of_acceptance' => $request->input('receipt_date'), // Ensure receipt_date is included if needed
            'date_of_issue' => $request->input('given_date'), // Ensure given_date is included if needed
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Debtor added successfully!');
    }
}
