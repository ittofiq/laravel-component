@extends('layouts.admin')

@section('title', 'Settings')

@section('breadcrumb')
<div class="mb-4">
    <x-navigation.breadcrumb :items="[
        ['label' => 'Home', 'href' => '/admin', 'icon' => '🏠'],
        ['label' => 'Settings'],
    ]" separator="chevron" />
</div>
@endsection

@section('content')
<div class="space-y-6">
    <x-layout.page-header title="Settings" description="Kelola preferensi aplikasi." />

    <div class="max-w-2xl space-y-6">
        {{-- General --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6">
            <h3 class="font-semibold text-gray-900 dark:text-white mb-4">General</h3>
            <div class="space-y-4">
                <x-form.input name="site_name" label="Nama Situs" placeholder="BacaDev" />
                <x-form.input name="site_url" label="URL Situs" placeholder="https://bacadev.test" />
                <x-form.textarea name="description" label="Deskripsi" rows="3" placeholder="Deskripsi singkat aplikasi..." />
            </div>
        </div>

        {{-- Notifications --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6">
            <h3 class="font-semibold text-gray-900 dark:text-white mb-4">Notifikasi</h3>
            <div class="space-y-4">
                <x-form.toggle name="email_notif" label="Email Notifications" :checked="true" />
                <x-form.toggle name="sms_notif" label="SMS Notifications" />
                <x-form.toggle name="push_notif" label="Push Notifications" :checked="true" color="green" />
            </div>
        </div>

        {{-- Preferences --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 p-6">
            <h3 class="font-semibold text-gray-900 dark:text-white mb-4">Preferensi</h3>
            <div class="space-y-4">
                <x-form.select name="language" label="Bahasa" :options="['id' => 'Indonesia', 'en' => 'English']" />
                <x-form.select name="timezone" label="Zona Waktu" :options="['asia' => 'Asia/Jakarta', 'utc' => 'UTC', 'sg' => 'Asia/Singapore']" />
            </div>
        </div>

        {{-- Save --}}
        <div class="flex justify-end gap-2">
            <x-ui.button variant="secondary">Batal</x-ui.button>
            <x-ui.button variant="primary">Simpan Perubahan</x-ui.button>
        </div>
    </div>
</div>
@endsection