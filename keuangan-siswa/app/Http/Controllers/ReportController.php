<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Data bulan ini
        $startMonth = Carbon::now()->startOfMonth();
        $endMonth   = Carbon::now()->endOfMonth();

        $incomeMonth = Transaction::where('user_id', $userId)
            ->whereBetween('created_at', [$startMonth, $endMonth])
            ->whereHas('category', fn($q) => $q->where('type', 'income'))
            ->sum('amount');

        $expenseMonth = Transaction::where('user_id', $userId)
            ->whereBetween('created_at', [$startMonth, $endMonth])
            ->whereHas('category', fn($q) => $q->where('type', 'expense'))
            ->sum('amount');

        $saldoMonth = $incomeMonth - $expenseMonth;

        return view('report', compact('incomeMonth', 'expenseMonth', 'saldoMonth'));
    }
}