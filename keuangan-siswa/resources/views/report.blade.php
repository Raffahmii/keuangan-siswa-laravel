<x-app-layout>
    @section('header', 'Laporan Keuangan')

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Card Ringkasan -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 transition-all duration-500 hover:shadow-2xl">
            <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4 flex items-center gap-2">
                <i class="fas fa-chart-pie text-teal-500"></i> Ringkasan Bulan Ini
            </h3>
            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <span class="text-gray-600 dark:text-gray-300 font-medium">Total Pemasukan</span>
                    <span class="font-bold text-green-600 dark:text-green-400">Rp {{ number_format($incomeMonth, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-gray-600 dark:text-gray-300 font-medium">Total Pengeluaran</span>
                    <span class="font-bold text-red-600 dark:text-red-400">Rp {{ number_format($expenseMonth, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between items-center border-t dark:border-gray-700 pt-2">
                    <span class="text-gray-800 dark:text-white font-semibold">Saldo Bulan Ini</span>
                    <span class="font-extrabold text-teal-600 dark:text-teal-400">Rp {{ number_format($saldoMonth, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Card Info -->
        <div class="bg-gradient-to-br from-teal-50 to-cyan-50 dark:from-teal-900/20 dark:to-cyan-900/20 rounded-2xl shadow-lg p-6 border border-teal-100 dark:border-teal-800 transition-all duration-500 hover:shadow-2xl">
            <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-2 flex items-center gap-2">
                <i class="fas fa-lightbulb text-yellow-500"></i> Fitur Laporan
            </h3>
            <p class="text-sm text-gray-600 dark:text-gray-300">Halaman ini sedang dikembangkan. Nanti kamu bisa melihat grafik perbandingan, export PDF/Excel, dan filter periode yang lebih detail.</p>
            <div class="mt-4 flex items-center gap-2 text-teal-600 dark:text-teal-400">
                <i class="fas fa-spinner animate-spin"></i>
                <span class="text-xs font-bold">Coming soon...</span>
            </div>
        </div>

        <!-- Placeholder Chart (bisa diisi nanti) -->
        <div class="md:col-span-2 bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 transition-all duration-500 hover:shadow-2xl">
            <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4">Preview Grafik (Coming Soon)</h3>
            <div class="h-64 bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center text-gray-400 dark:text-gray-500">
                <i class="fas fa-chart-line text-4xl"></i>
                <span class="ml-2 font-medium">Grafik akan muncul di sini</span>
            </div>
        </div>
    </div>
</x-app-layout>