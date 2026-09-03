@extends('layouts.app')

@section('title', 'Auth Components - BacaDev')

@section('content')
<div class="flex min-h-screen">
    @include('pages.components.sidebar', ['currentCategory' => 'auth'])

    <div class="flex-1 min-w-0 px-4 py-8">
        <h1 class="text-3xl font-bold mb-2 text-gray-900 dark:text-white">🔐 Auth Components</h1>
        <p class="text-gray-600 dark:text-gray-400 mb-8">4 komponen: Login Card, Register Card, Reset Password Card, Change Password Card</p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

            <x-ui.demo-card title="Login Card" component="auth.login-card" :props="[
                ['name' => 'title', 'type' => 'string', 'default' => '\'Sign In\'', 'description' => 'Judul form'],
                ['name' => 'subtitle', 'type' => 'string|null', 'default' => 'null', 'description' => 'Sub judul'],
                ['name' => 'action', 'type' => 'string', 'default' => '\'#\'', 'description' => 'URL form action'],
                ['name' => 'submitLabel', 'type' => 'string', 'default' => '\'Masuk\'', 'description' => 'Teks tombol submit'],
                ['name' => 'footerLinkLabel', 'type' => 'string', 'default' => '\'Daftar\'', 'description' => 'Teks link footer'],
            ]">
                <div class="bg-gray-50 dark:bg-gray-900 rounded-xl p-6">
                    <x-auth.login-card
                        title="Sign In"
                        subtitle="Selamat datang kembali!"
                        submitLabel="Masuk"
                        footerLinkLabel="Daftar"
                    />
                </div>
            </x-ui.demo-card>

            <x-ui.demo-card title="Register Card" component="auth.register-card" :props="[
                ['name' => 'title', 'type' => 'string', 'default' => '\'Create Account\'', 'description' => 'Judul form'],
                ['name' => 'subtitle', 'type' => 'string|null', 'default' => 'null', 'description' => 'Sub judul'],
                ['name' => 'action', 'type' => 'string', 'default' => '\'#\'', 'description' => 'URL form action'],
                ['name' => 'submitLabel', 'type' => 'string', 'default' => '\'Daftar\'', 'description' => 'Teks tombol submit'],
                ['name' => 'footerLinkLabel', 'type' => 'string', 'default' => '\'Masuk\'', 'description' => 'Teks link footer'],
            ]">
                <div class="bg-gray-50 dark:bg-gray-900 rounded-xl p-6">
                    <x-auth.register-card
                        title="Buat Akun"
                        subtitle="Isi data untuk memulai"
                        submitLabel="Daftar"
                        footerText="Sudah punya akun?"
                        footerLinkLabel="Masuk"
                    />
                </div>
            </x-ui.demo-card>

            <x-ui.demo-card title="Reset Password Card" component="auth.reset-password-card" :props="[
                ['name' => 'title', 'type' => 'string', 'default' => '\'Reset Password\'', 'description' => 'Judul form'],
                ['name' => 'subtitle', 'type' => 'string|null', 'default' => 'null', 'description' => 'Sub judul'],
                ['name' => 'action', 'type' => 'string', 'default' => '\'#\'', 'description' => 'URL form action'],
                ['name' => 'submitLabel', 'type' => 'string', 'default' => '\'Kirim Link Reset\'', 'description' => 'Teks tombol submit'],
                ['name' => 'backLabel', 'type' => 'string', 'default' => '\'Kembali ke login\'', 'description' => 'Teks link kembali'],
            ]">
                <div class="bg-gray-50 dark:bg-gray-900 rounded-xl p-6">
                    <x-auth.reset-password-card title="Reset Password" submitLabel="Kirim Link" backLabel="← Kembali" />
                </div>
            </x-ui.demo-card>

            <x-ui.demo-card title="Change Password Card" component="auth.change-password-card" :props="[
                ['name' => 'title', 'type' => 'string', 'default' => '\'Ubah Password\'', 'description' => 'Judul form'],
                ['name' => 'subtitle', 'type' => 'string|null', 'default' => 'null', 'description' => 'Sub judul'],
                ['name' => 'action', 'type' => 'string', 'default' => '\'#\'', 'description' => 'URL form action'],
                ['name' => 'submitLabel', 'type' => 'string', 'default' => '\'Ubah Password\'', 'description' => 'Teks tombol submit'],
            ]">
                <div class="bg-gray-50 dark:bg-gray-900 rounded-xl p-6">
                    <x-auth.change-password-card title="Ubah Password" submitLabel="Perbarui" />
                </div>
            </x-ui.demo-card>

        </div>
    </div>
</div>
@endsection