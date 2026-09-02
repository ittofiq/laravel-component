@extends('layouts.app')
@section('title', 'Feedback - BacaDev')
@section('content')
<div class="flex min-h-screen">
    @include('pages.components.sidebar', ['currentCategory' => 'feedback'])
    <div class="flex-1 min-w-0 px-4 py-8">
        <h1 class="text-3xl font-bold mb-2 text-gray-900 dark:text-white">🔔 Feedback</h1>
        <p class="text-gray-600 dark:text-gray-400 mb-8">6 komponen: Alert, Toast, Toast Container, Spinner, Skeleton, Empty State</p>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">

            <x-ui.demo-card title="Alert" component="feedback.alert" :props="[
                ['name' => 'type', 'type' => 'string', 'default' => '\'info\'', 'description' => 'info, success, warning, danger'],
                ['name' => 'title', 'type' => 'string|null', 'default' => 'null', 'description' => 'Judul alert'],
                ['name' => 'dismissible', 'type' => 'bool', 'default' => 'false', 'description' => 'Tampilkan tombol tutup'],
                ['name' => 'link', 'type' => 'string|null', 'default' => 'null', 'description' => 'Link aksi'],
                ['name' => 'linkText', 'type' => 'string', 'default' => '\'Learn more\'', 'description' => 'Teks link aksi'],
            ]">
                <x-feedback.alert type="info" title="Information" :dismissible="true" link="#" linkText="View details">
                    Your account has been updated successfully. Please review the changes.
                </x-feedback.alert>
                <x-feedback.alert type="success" title="Success" :dismissible="true">
                    Data berhasil disimpan ke database.
                </x-feedback.alert>
                <x-feedback.alert type="warning" title="Warning" :dismissible="true" link="#" linkText="Learn more">
                    Your subscription will expire in 7 days. Renew to avoid service interruption.
                </x-feedback.alert>
                <x-feedback.alert type="danger" title="Error" :dismissible="true" link="#" linkText="Troubleshoot">
                    Failed to process payment. Please check your card details and try again.
                </x-feedback.alert>
            </x-ui.demo-card>

            <x-ui.demo-card title="Toast" component="feedback.toast-container" :props="[
                ['name' => 'position', 'type' => 'string', 'default' => '\'top-right\'', 'description' => 'Posisi toast'],
                ['name' => 'maxToasts', 'type' => 'int', 'default' => '5', 'description' => 'Maksimal toast tampil'],
            ]">
                <p class="text-xs text-gray-500 mb-3">Klik tombol untuk memunculkan toast:</p>
                <div class="flex flex-wrap gap-2">
                    <button onclick="window.showToast({type:'success',message:'Operasi berhasil!'})" class="px-3 py-1.5 text-sm bg-green-500 text-white rounded">✅ Success</button>
                    <button onclick="window.showToast({type:'error',message:'Terjadi kesalahan!'})" class="px-3 py-1.5 text-sm bg-red-500 text-white rounded">❌ Error</button>
                    <button onclick="window.showToast({type:'warning',message:'Perhatian!'})" class="px-3 py-1.5 text-sm bg-yellow-500 text-white rounded">⚠️ Warning</button>
                    <button onclick="window.showToast({type:'info',message:'Info update'})" class="px-3 py-1.5 text-sm bg-blue-500 text-white rounded">ℹ️ Info</button>
                </div>
                <x-feedback.toast-container position="top-right" />
            </x-ui.demo-card>

            <x-ui.demo-card title="Spinner" component="feedback.spinner" :props="[
                ['name' => 'size', 'type' => 'string', 'default' => '\'md\'', 'description' => 'Ukuran: sm, md, lg'],
                ['name' => 'color', 'type' => 'string', 'default' => '\'blue\'', 'description' => 'Warna spinner'],
                ['name' => 'label', 'type' => 'string|null', 'default' => 'null', 'description' => 'Teks di samping spinner'],
            ]">
                <div class="flex gap-4 items-center">
                    <x-feedback.spinner size="sm" />
                    <x-feedback.spinner size="md" />
                    <x-feedback.spinner size="lg" />
                    <x-feedback.spinner size="md" color="green" />
                    <x-feedback.spinner size="md" color="red" />
                    <x-feedback.spinner size="md" color="white" />
                    <x-feedback.spinner size="lg" color="blue" label="Loading..." />
                </div>
            </x-ui.demo-card>

            <x-ui.demo-card title="Skeleton" component="feedback.skeleton" :props="[
                ['name' => 'type', 'type' => 'string', 'default' => '\'text\'', 'description' => 'text, image, circle, card, profile, paragraph, table-row'],
                ['name' => 'count', 'type' => 'int', 'default' => '3', 'description' => 'Jumlah item skeleton'],
                ['name' => 'width', 'type' => 'int|null', 'default' => 'null', 'description' => 'Lebar (image)'],
                ['name' => 'height', 'type' => 'int|null', 'default' => 'null', 'description' => 'Tinggi (image)'],
                ['name' => 'size', 'type' => 'string', 'default' => '\'md\'', 'description' => 'Ukuran untuk circle'],
            ]">
                <x-feedback.skeleton type="text" :count="3" />
                <x-feedback.skeleton type="image" :width="300" :height="150" class="mt-3" />
                <div class="flex gap-3 mt-3">
                    <x-feedback.skeleton type="circle" size="sm" />
                    <x-feedback.skeleton type="circle" size="md" />
                    <x-feedback.skeleton type="circle" size="lg" />
                </div>
                <x-feedback.skeleton type="card" :count="1" class="mt-3" />
                <x-feedback.skeleton type="table-row" :count="3" class="mt-3" />
            </x-ui.demo-card>

            <x-ui.demo-card title="Empty State" component="feedback.empty-state" :props="[
                ['name' => 'icon', 'type' => 'string', 'default' => '\'📭\'', 'description' => 'Emoji/ikon'],
                ['name' => 'title', 'type' => 'string', 'default' => '\'Tidak ada data\'', 'description' => 'Judul'],
                ['name' => 'message', 'type' => 'string', 'default' => '—', 'description' => 'Pesan keterangan'],
            ]">
                <x-feedback.empty-state icon="🔍" title="No Results" message="Try different keywords" />
                <x-feedback.empty-state icon="📭" title="No Messages" message="Your inbox is empty" class="mt-4" />
                <x-feedback.empty-state icon="📦" title="No Products" message="Add your first product to get started" class="mt-4" />
            </x-ui.demo-card>

        </div>
    </div>
</div>
@endsection