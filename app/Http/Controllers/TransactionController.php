<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    // List all transactions for the logged-in user
    public function index()
    {
        return Transaction::where('user_id', Auth::id())->get();
    }

    // Store a new transaction
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'amount' => 'required|numeric',
            'type' => 'required|in:income,expense',
            'description' => 'nullable|string',
        ]);

        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'amount' => $request->amount,
            'type' => $request->type,
            'description' => $request->description,
        ]);

        return response()->json($transaction, 201);
    }

    // Show a single transaction
    public function show($id)
    {
        return Transaction::where('user_id', Auth::id())->findOrFail($id);
    }

    // Update a transaction
    public function update(Request $request, $id)
    {
        $transaction = Transaction::where('user_id', Auth::id())->findOrFail($id);

        $transaction->update($request->only('title', 'amount', 'type', 'description'));

        return response()->json($transaction);
    }

    // Delete a transaction
    public function destroy($id)
    {
        $transaction = Transaction::where('user_id', Auth::id())->findOrFail($id);
        $transaction->delete();

        return response()->json(null, 204);
    }
}
