{{-- Komponen Change Password Card — form ubah password (untuk user login) --}}
@props([
    'title' => 'Ubah Password',
    'subtitle' => 'Perbarui password akun Anda.',
    'action' => '#',
    'method' => 'POST',
    'brand' => 'B',
    'currentPasswordLabel' => 'Password Saat Ini',
    'currentPasswordPlaceholder' => 'Masukkan password saat ini',
    'newPasswordLabel' => 'Password Baru',
    'newPasswordPlaceholder' => 'Buat password baru',
    'confirmLabel' => 'Konfirmasi Password Baru',
    'confirmPlaceholder' => 'Ulangi password baru',
    'submitLabel' => 'Ubah Password',
])

<div class="w-full max-w-sm mx-auto">
    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-lg p-6 lg:p-8">
        {{-- Header --}}
        <div class="text-center mb-6">
            <div class="w-12 h-12 mx-auto rounded-xl bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-white text-xl font-bold mb-3">{{ $brand }}</div>
            <h2 class="text-xl font-bold text-gray-900 dark:text-white">{{ $title }}</h2>
            @if($subtitle)
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">{{ $subtitle }}</p>
            @endif
        </div>

        <form action="{{ $action }}" method="{{ $method }}" class="space-y-4">
            @csrf
            <x-form.password-input name="current_password" :label="$currentPasswordLabel" :placeholder="$currentPasswordPlaceholder" />
            <x-form.password-input name="password" :label="$newPasswordLabel" :placeholder="$newPasswordPlaceholder" />
            <x-form.password-input name="password_confirm" :label="$confirmLabel" :placeholder="$confirmPlaceholder" />

            <x-ui.button type="submit" variant="primary" class="w-full justify-center">{{ $submitLabel }}</x-ui.button>
        </form>
    </div>
</div>