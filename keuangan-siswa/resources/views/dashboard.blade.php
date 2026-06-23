<x-app-layout>
    @section('header', 'Dashboard')

    <div class="space-y-8">
        <!-- Cards Statistik -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
            <!-- Pemasukan -->
            <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-4 sm:p-6 border-l-8 border-green-500 hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 uppercase font-semibold">Pemasukan</p>
                        <p class="text-base sm:text-xl font-extrabold text-gray-800 dark:text-white">Rp {{ number_format($totalIncome, 0, ',', '.') }}</p>
                    </div>
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center text-green-600 dark:text-green-400 group-hover:animate-bounce-slow">
                        <i class="fas fa-arrow-down fa-rotate-180 text-lg sm:text-xl"></i>
                    </div>
                </div>
            </div>
            <!-- Pengeluaran -->
            <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-4 sm:p-6 border-l-8 border-red-500 hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 uppercase font-semibold">Pengeluaran</p>
                        <p class="text-base sm:text-xl font-extrabold text-gray-800 dark:text-white">Rp {{ number_format($totalExpense, 0, ',', '.') }}</p>
                    </div>
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center text-red-600 dark:text-red-400 group-hover:animate-bounce-slow">
                        <i class="fas fa-arrow-up text-lg sm:text-xl"></i>
                    </div>
                </div>
            </div>
            <!-- Saldo -->
            <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-4 sm:p-6 border-l-8 border-blue-500 hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 uppercase font-semibold">Saldo</p>
                        <p class="text-base sm:text-xl font-extrabold text-gray-800 dark:text-white">Rp {{ number_format($saldo, 0, ',', '.') }}</p>
                    </div>
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center text-blue-600 dark:text-blue-400 group-hover:animate-pulse-slow">
                        <i class="fas fa-wallet text-lg sm:text-xl"></i>
                    </div>
                </div>
            </div>
            <!-- Saldo Bulan Ini -->
            <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-4 sm:p-6 border-l-8 border-purple-500 hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 uppercase font-semibold">Saldo Bulan Ini</p>
                        <p class="text-base sm:text-xl font-extrabold text-gray-800 dark:text-white">Rp {{ number_format($saldoMonth, 0, ',', '.') }}</p>
                    </div>
                    <div class="w-10 h-10 sm:w-12 sm:h-12 bg-purple-100 dark:bg-purple-900/30 rounded-full flex items-center justify-center text-purple-600 dark:text-purple-400 group-hover:animate-float">
                        <i class="fas fa-calendar-alt text-lg sm:text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grafik dan Aktivitas -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Grafik -->
            <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-4 sm:p-6 transition-all duration-500 hover:shadow-2xl">
                <h3 class="text-base sm:text-lg font-bold text-gray-800 dark:text-white mb-4">Pemasukan & Pengeluaran (7 Hari Terakhir)</h3>
                <div class="h-64 sm:h-80">
                    <canvas id="transactionChart"></canvas>
                </div>
            </div>

            <!-- Aktivitas Terkini + Tips -->
            <div class="space-y-6">
                <!-- Aktivitas Terkini -->
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-4 sm:p-6 transition-all duration-500 hover:shadow-2xl">
                    <h3 class="text-base sm:text-lg font-bold text-gray-800 dark:text-white mb-4 flex items-center gap-2">
                        <i class="fas fa-clock text-teal-500"></i> Aktivitas Terkini
                    </h3>
                    <div class="space-y-3">
                        @foreach($recentTransactions->take(3) as $tr)
                        <div class="flex items-center gap-3 p-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-300">
                            <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full {{ $tr->category->type == 'income' ? 'bg-green-100 dark:bg-green-900/30 text-green-600' : 'bg-red-100 dark:bg-red-900/30 text-red-600' }} flex items-center justify-center">
                                <i class="fas {{ $tr->category->type == 'income' ? 'fa-arrow-down' : 'fa-arrow-up' }} text-sm sm:text-base"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs sm:text-sm font-semibold text-gray-800 dark:text-white truncate">{{ $tr->description ?? 'Transaksi' }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ \Carbon\Carbon::parse($tr->date)->format('d M') }} • {{ $tr->category->name }}</p>
                            </div>
                            <span class="text-xs sm:text-sm font-bold {{ $tr->category->type == 'income' ? 'text-green-600' : 'text-red-600' }}">
                                Rp {{ number_format($tr->amount, 0, ',', '.') }}
                            </span>
                        </div>
                        @endforeach
                    </div>
                    <a href="{{ route('transactions.index') }}" class="mt-4 inline-block text-xs sm:text-sm font-semibold text-teal-600 dark:text-teal-400 hover:underline">Lihat semua transaksi →</a>
                </div>

                <!-- Tips Keuangan -->
                <div class="bg-gradient-to-br from-teal-50 to-cyan-50 dark:from-teal-900/20 dark:to-cyan-900/20 rounded-2xl shadow-lg p-4 sm:p-6 border border-teal-100 dark:border-teal-800 transition-all duration-500 hover:shadow-2xl">
                    <h3 class="text-base sm:text-lg font-bold text-gray-800 dark:text-white mb-2 flex items-center gap-2">
                        <i class="fas fa-lightbulb text-yellow-500"></i> Tips Hemat
                    </h3>
                    <p class="text-xs sm:text-sm font-medium text-gray-600 dark:text-gray-300">Catat setiap pengeluaran kecil, karena lama-lama jadi bukit! Gunakan fitur kategori untuk melacak pengeluaranmu.</p>
                    <div class="mt-4 flex items-center gap-2 text-teal-600 dark:text-teal-400">
                        <i class="fas fa-chart-line animate-pulse-slow"></i>
                        <span class="text-xs font-bold">+5% lebih hemat bulan ini</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Transactions -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-4 sm:p-6 transition-all duration-500 hover:shadow-2xl">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-base sm:text-lg font-bold text-gray-800 dark:text-white">Transaksi Terbaru</h3>
                <a href="{{ route('transactions.index') }}" class="text-xs sm:text-sm font-semibold text-teal-600 dark:text-teal-400 hover:underline">Lihat Semua</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-xs sm:text-sm">
                    <thead class="bg-gray-50 dark:bg-gray-700 border-b dark:border-gray-600">
                        <tr>
                            <th class="px-2 sm:px-4 py-2 sm:py-3 text-left font-bold text-gray-500 dark:text-gray-300 uppercase">Tanggal</th>
                            <th class="px-2 sm:px-4 py-2 sm:py-3 text-left font-bold text-gray-500 dark:text-gray-300 uppercase">Kategori</th>
                            <th class="px-2 sm:px-4 py-2 sm:py-3 text-left font-bold text-gray-500 dark:text-gray-300 uppercase">Deskripsi</th>
                            <th class="px-2 sm:px-4 py-2 sm:py-3 text-left font-bold text-gray-500 dark:text-gray-300 uppercase">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y dark:divide-gray-700">
                        @foreach($recentTransactions as $tr)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                            <td class="px-2 sm:px-4 py-2 sm:py-3 font-medium text-gray-700 dark:text-gray-300">{{ \Carbon\Carbon::parse($tr->date)->format('d/m/Y') }}</td>
                            <td class="px-2 sm:px-4 py-2 sm:py-3">
                                <span class="px-1 sm:px-2 py-0.5 sm:py-1 rounded-full text-xs font-semibold {{ $tr->category->type == 'income' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300' : 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300' }}">
                                    {{ $tr->category->name }}
                                </span>
                            </td>
                            <td class="px-2 sm:px-4 py-2 sm:py-3 font-medium text-gray-700 dark:text-gray-300">{{ $tr->description ?? '-' }}</td>
                            <td class="px-2 sm:px-4 py-2 sm:py-3 font-bold {{ $tr->category->type == 'income' ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                Rp {{ number_format($tr->amount, 0, ',', '.') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        const ctx = document.getElementById('transactionChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($days),
                datasets: [
                    {
                        label: 'Pemasukan',
                        data: @json($incomeChart),
                        borderColor: '#10b981',
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        tension: 0.3,
                        fill: true
                    },
                    {
                        label: 'Pengeluaran',
                        data: @json($expenseChart),
                        borderColor: '#ef4444',
                        backgroundColor: 'rgba(239, 68, 68, 0.1)',
                        tension: 0.3,
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { 
                        position: 'top', 
                        labels: { 
                            color: document.documentElement.classList.contains('dark') ? '#fff' : '#333',
                            font: { size: 12, weight: 'bold' }
                        } 
                    }
                },
                scales: {
                    y: { 
                        ticks: { 
                            color: document.documentElement.classList.contains('dark') ? '#ccc' : '#666',
                            font: { size: 11, weight: 'bold' }
                        },
                        grid: { color: document.documentElement.classList.contains('dark') ? '#444' : '#ddd' }
                    },
                    x: { 
                        ticks: { 
                            color: document.documentElement.classList.contains('dark') ? '#ccc' : '#666',
                            font: { size: 11, weight: 'bold' }
                        },
                        grid: { color: document.documentElement.classList.contains('dark') ? '#444' : '#ddd' }
                    }
                }
            }
        });
    </script>
    @endpush
</x-app-layout>