<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Category;
use Illuminate\Http\Request;

class TransactionController extends Controller
    {
        public function index(Request $request)
    {
        $userId = auth()->id();

        $query = Transaction::where('user_id', $userId);

        if ($request->month && $request->year) {
            $query->whereMonth('date', $request->month)
                ->whereYear('date', $request->year);
        }

        $transactions = $query->get();

        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $categories = \App\Models\Category::where('user_id', auth()->id())->get();
        return view('transactions.create', compact('categories'));
    }


    public function store(Request $request)
    {
        $request->validate([
        'category_id' => 'required|exists:categories,id',
        'amount' => 'required|integer|min:1',
        'date' => 'required|date',
        'description' => 'nullable|string|max:255'
        ]);
        Transaction::create([
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
            'amount' => $request->amount,
            'description' => $request->description,
            'date' => $request->date,
        ]);

        return redirect()->route('transactions.index');
    }

    public function edit(Transaction $transaction)
    {
        if ($transaction->user_id != auth()->id()) {
            abort(403);
        }

        $categories = \App\Models\Category::where('user_id', auth()->id())->get();

        return view('transactions.edit', compact('transaction', 'categories'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        if ($transaction->user_id != auth()->id()) {
            abort(403);
        }

        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'amount' => 'required|integer|min:1',
            'date' => 'required|date',
            'description' => 'nullable|string|max:255'
        ]);

        $transaction->update([
            'category_id' => $request->category_id,
            'amount' => $request->amount,
            'description' => $request->description,
            'date' => $request->date,
        ]);

        return redirect()->route('transactions.index');
    }

    public function destroy(Transaction $transaction)
    {
        if ($transaction->user_id != auth()->id()) {
            abort(403);
        }

        $transaction->delete();

        return redirect()->route('transactions.index');
    }
}