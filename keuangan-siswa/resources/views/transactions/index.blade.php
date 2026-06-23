<x-app-layout>
    @section('header', 'Transaksi')

    <div class="space-y-6">
        <!-- Filter -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 transition-all duration-500 hover:shadow-2xl">
            <form method="GET" action="{{ route('transactions.index') }}" class="flex flex-wrap items-end gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Bulan</label>
                    <input type="number" name="month" min="1" max="12" value="{{ request('month') }}" class="border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500 w-24">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tahun</label>
                    <input type="number" name="year" value="{{ request('year') }}" class="border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500 w-24">
                </div>
                <div>
                    <button type="submit" class="bg-teal-600 dark:bg-teal-500 text-white px-4 py-2 rounded-lg hover:bg-teal-700 dark:hover:bg-teal-600 transition-colors duration-200">Filter</button>
                </div>
                <div class="ml-auto">
                    <a href="{{ route('transactions.create') }}" class="bg-gradient-to-r from-teal-600 to-cyan-600 dark:from-teal-500 dark:to-cyan-500 text-white px-4 py-2 rounded-lg hover:shadow-md transition-all duration-300 hover:scale-105 flex items-center gap-2">
                        <i class="fas fa-plus"></i> Tambah Transaksi
                    </a>
                </div>
            </form>
        </div>

        <!-- Tabel -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 transition-all duration-500 hover:shadow-2xl">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 dark:bg-gray-700 border-b dark:border-gray-600">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Tanggal</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Kategori</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Deskripsi</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Jumlah</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y dark:divide-gray-700">
                        @foreach($transactions as $tr)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                            <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">{{ \Carbon\Carbon::parse($tr->date)->format('d/m/Y') }}</td>
                            <td class="px-4 py-3 text-sm">
                                <span class="px-2 py-1 rounded-full text-xs {{ $tr->category->type == 'income' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300' : 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300' }}">
                                    {{ $tr->category->name }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300">{{ $tr->description ?? '-' }}</td>
                            <td class="px-4 py-3 text-sm font-medium {{ $tr->category->type == 'income' ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                                Rp {{ number_format($tr->amount, 0, ',', '.') }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                <a href="{{ route('transactions.edit', $tr->id) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300 transition-colors duration-200 mr-3">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('transactions.destroy', $tr->id) }}" method="POST" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300 transition-colors duration-200" onclick="return confirm('Yakin hapus transaksi ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>