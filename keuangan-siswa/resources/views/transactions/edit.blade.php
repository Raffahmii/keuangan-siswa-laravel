<x-app-layout>
    @section('header', 'Edit Transaksi')

    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 max-w-2xl transition-all duration-500 hover:shadow-2xl">
        <form method="POST" action="{{ route('transactions.update', $transaction->id) }}">
            @csrf @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Kategori</label>
                <select name="category_id" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ $transaction->category_id == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }} ({{ $cat->type == 'income' ? 'Pemasukan' : 'Pengeluaran' }})
                        </option>
                    @endforeach
                </select>
                @error('category_id') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Jumlah (Rp)</label>
                <input type="number" name="amount" value="{{ old('amount', $transaction->amount) }}" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500">
                @error('amount') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Deskripsi</label>
                <input type="text" name="description" value="{{ old('description', $transaction->description) }}" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500" placeholder="Opsional">
                @error('description') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tanggal</label>
                <input type="date" name="date" value="{{ old('date', $transaction->date) }}" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500">
                @error('date') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center justify-end gap-3">
                <a href="{{ route('transactions.index') }}" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">Batal</a>
                <button type="submit" class="px-4 py-2 bg-gradient-to-r from-teal-600 to-cyan-600 dark:from-teal-500 dark:to-cyan-500 text-white rounded-lg hover:shadow-md transition-all duration-300 hover:scale-105">Update</button>
            </div>
        </form>
    </div>
</x-app-layout>