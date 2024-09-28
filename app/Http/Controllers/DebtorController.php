<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Debtor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DebtorController extends Controller
{

    public function index()
    {
        $userId = Auth::id(); // Get the ID of the authenticated user

        // Retrieve debtors associated with the authenticated user
        $debtors = Debtor::where('user_id', $userId)->with('user')->get();
        $currency = Currency::all();

        return view('components.debtors', [
            'debtors' => $debtors,
            'currency' => $currency
        ]);
    }

    public function show($id)
    {
        $userId = Auth::id(); // Get the ID of the authenticated user

        // Retrieve debtors associated with the authenticated user
        $debtors = Debtor::where('user_id', $userId)->with('user')->get();
        $currency = Currency::all(); // List of all currencies

        // Retrieve the specific debtor
        $debtor = Debtor::with('payments')->find($id);

        // Check if the authenticated user owns the debtor
        if ($debtor->user_id != $userId) {
            // Handle unauthorized access
            abort(403, 'Unauthorized action.');
        }

        return view('components.show-debtor', [
            'debtors' => $debtors,
            'currency' => $currency,
            'debtor' => $debtor
        ]);
    }



    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:1',
            'address' => 'required|string|min:1',
            'phone' => 'required|string|min:8',
        ]);


        // Create a new Debtor record
        Debtor::create([
            'user_id' => Auth::id(),
            'name' => $request->name, // Corrected this line
            'address' => $request->address,
            'phone' => $request->phone,
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Debtor added successfully!');
    }
}
