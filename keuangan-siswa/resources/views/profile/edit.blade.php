<x-app-layout>
    @section('header', 'Pengaturan Profil')

    <div class="space-y-6">
        <!-- Update Profile Information -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 transition-all duration-500 hover:shadow-2xl">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Informasi Profil</h3>
            @include('profile.partials.update-profile-information-form')
        </div>

        <!-- Update Password -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 transition-all duration-500 hover:shadow-2xl">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Ubah Password</h3>
            @include('profile.partials.update-password-form')
        </div>

        <!-- Delete User -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg p-6 transition-all duration-500 hover:shadow-2xl">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Hapus Akun</h3>
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</x-app-layout>