<x-app-layout>
    @section('header', 'Edit Kategori')

    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 max-w-2xl transition-all duration-500 hover:shadow-2xl">
        <form method="POST" action="{{ route('categories.update', $category->id) }}">
            @csrf @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Nama Kategori</label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500">
                @error('name') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tipe</label>
                <select name="type" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500">
                    <option value="income" {{ $category->type == 'income' ? 'selected' : '' }}>Pemasukan</option>
                    <option value="expense" {{ $category->type == 'expense' ? 'selected' : '' }}>Pengeluaran</option>
                </select>
                @error('type') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center justify-end gap-3">
                <a href="{{ route('categories.index') }}" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">Batal</a>
                <button type="submit" class="px-4 py-2 bg-gradient-to-r from-teal-600 to-cyan-600 dark:from-teal-500 dark:to-cyan-500 text-white rounded-lg hover:shadow-md transition-all duration-300 hover:scale-105">Update</button>
            </div>
        </form>
    </div>
</x-app-layout>