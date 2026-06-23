<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // ==============================
        // TOTAL SEMUA
        // ==============================

        $totalIncome = Transaction::where('user_id', $userId)
            ->whereHas('category', fn($q) => $q->where('type', 'income'))
            ->sum('amount');

        $totalExpense = Transaction::where('user_id', $userId)
            ->whereHas('category', fn($q) => $q->where('type', 'expense'))
            ->sum('amount');

        $saldo = $totalIncome - $totalExpense;

        // ==============================
        // BULAN INI
        // ==============================

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

        // ==============================
        // 5 TRANSAKSI TERBARU
        // ==============================

        $recentTransactions = Transaction::with('category')
            ->where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();

        // ==============================
        // DATA CHART 7 HARI TERAKHIR
        // ==============================

        $days = [];
        $incomeChart = [];
        $expenseChart = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $dayStart = $date->copy()->startOfDay();
            $dayEnd = $date->copy()->endOfDay();

            $income = Transaction::where('user_id', $userId)
                ->whereBetween('created_at', [$dayStart, $dayEnd])
                ->whereHas('category', fn($q) => $q->where('type', 'income'))
                ->sum('amount');

            $expense = Transaction::where('user_id', $userId)
                ->whereBetween('created_at', [$dayStart, $dayEnd])
                ->whereHas('category', fn($q) => $q->where('type', 'expense'))
                ->sum('amount');

            $days[] = $date->format('D'); // Sen, Sel, Rab, Kam, Jum, Sab, Min
            $incomeChart[] = $income;
            $expenseChart[] = $expense;
        }

        // ==============================

        $tanggalMulai = Carbon::parse(Auth::user()->created_at)
            ->timezone('Asia/Jakarta')
            ->format('d/m/Y H:i') . ' WIB';

        return view('dashboard', compact(
            'totalIncome',
            'totalExpense',
            'saldo',
            'incomeMonth',
            'expenseMonth',
            'saldoMonth',
            'recentTransactions',
            'days',
            'incomeChart',
            'expenseChart',
            'tanggalMulai'
        ));
    }

    public function showLogoutForm()
    {
        return view('auth.confirm-logout');
    }

    public function logout(Request $request)
    {
        $request->validate([
            'password' => 'required'
        ]);

        if (!Hash::check($request->password, Auth::user()->password)) {
            return back()->with('error', 'Password salah!');
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Berhasil logout');
    }
}