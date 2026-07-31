@extends('layouts.app')
@section('title', 'Feedback - BacaDev')
@section('content')
<div class="flex min-h-screen">
    @include('pages.components.sidebar', ['currentCategory' => 'feedback'])
    <div class="flex-1 min-w-0 px-4 py-8">
        <h1 class="text-3xl font-bold mb-2 text-gray-900 dark:text-white">🔔 Feedback</h1>
        <p class="text-gray-600 dark:text-gray-400 mb-8">6 komponen: Alert, Toast, Toast Container, Spinner, Skeleton, Empty State</p>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Alert</h3>
                <x-feedback.alert type="info" title="Information" :dismissible="true" link="#" linkText="View details">
                    Your account has been updated successfully. Please review the changes.
                    <x-slot:actions>
                        <button class="px-3 py-1.5 text-xs font-medium bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">Review</button>
                        <button class="px-3 py-1.5 text-xs font-medium bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 transition">Dismiss</button>
                    </x-slot:actions>
                </x-feedback.alert>

                <x-feedback.alert type="success" title="Success" :dismissible="true">
                    Data berhasil disimpan ke database.
                </x-feedback.alert>

                <x-feedback.alert type="warning" title="Warning" :dismissible="true" link="#" linkText="Learn more">
                    Your subscription will expire in 7 days. Renew to avoid service interruption.
                </x-feedback.alert>

                <x-feedback.alert type="danger" title="Error" :dismissible="true" link="#" linkText="Troubleshoot">
                    Failed to process payment. Please check your card details and try again.
                    <x-slot:actions>
                        <button class="px-3 py-1.5 text-xs font-medium bg-red-500 text-white rounded-lg hover:bg-red-600 transition">Retry</button>
                    </x-slot:actions>
                </x-feedback.alert>
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Toast</h3>
                <p class="text-xs text-gray-500 mb-3">Klik tombol untuk memunculkan toast:</p>
                <div class="flex flex-wrap gap-2">
                    <button onclick="window.showToast({type:'success',message:'Operasi berhasil!'})" class="px-3 py-1.5 text-sm bg-green-500 text-white rounded">✅ Success</button>
                    <button onclick="window.showToast({type:'error',message:'Terjadi kesalahan!'})" class="px-3 py-1.5 text-sm bg-red-500 text-white rounded">❌ Error</button>
                    <button onclick="window.showToast({type:'warning',message:'Perhatian!'})" class="px-3 py-1.5 text-sm bg-yellow-500 text-white rounded">⚠️ Warning</button>
                    <button onclick="window.showToast({type:'info',message:'Info update'})" class="px-3 py-1.5 text-sm bg-blue-500 text-white rounded">ℹ️ Info</button>
                </div>
                <div class="flex flex-wrap gap-2 mt-3">
                        <button onclick="window.showToast({type:'success',title:'Berhasil!',message:'Data tersimpan.'})" class="px-3 py-1.5 text-sm bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300 rounded hover:bg-green-200 dark:hover:bg-green-900/50 transition">+ Title</button>
                        <button onclick="window.showToast({type:'error',title:'Error!',message:'Gagal memproses.',duration:5000})" class="px-3 py-1.5 text-sm bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 rounded hover:bg-red-200 dark:hover:bg-red-900/50 transition">5s Duration</button>
                    </div>
                    <x-feedback.toast-container position="top-right" />
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Spinner</h3>
                <div class="flex gap-4 items-center">
                    <x-feedback.spinner size="sm" />
                    <x-feedback.spinner size="md" />
                    <x-feedback.spinner size="lg" />
                    <x-feedback.spinner size="md" color="green" />
                    <x-feedback.spinner size="md" color="red" />
                    <x-feedback.spinner size="md" color="white" />
                    <x-feedback.spinner size="lg" color="blue" label="Loading..." />
                </div>
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Skeleton</h3>
                <x-feedback.skeleton type="text" :count="3" />
                <x-feedback.skeleton type="image" :width="300" :height="150" class="mt-3" />
                <div class="flex gap-3 mt-3">
                    <x-feedback.skeleton type="circle" size="sm" />
                    <x-feedback.skeleton type="circle" size="md" />
                    <x-feedback.skeleton type="circle" size="lg" />
                </div>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-3">Card & Profile</p>
                <div class="grid grid-cols-2 gap-3 mt-2">
                    <x-feedback.skeleton type="card" :count="1" />
                    <x-feedback.skeleton type="profile" size="md" />
                </div>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-3">Paragraph & Table</p>
                <x-feedback.skeleton type="paragraph" :count="5" class="mt-2" />
                <x-feedback.skeleton type="table-row" :count="3" class="mt-3" />
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Empty State</h3>
                <x-feedback.empty-state icon="🔍" title="No Results" message="Try different keywords" />
                <x-feedback.empty-state icon="📭" title="No Messages" message="Your inbox is empty" class="mt-4" />
                <x-feedback.empty-state icon="📦" title="No Products" message="Add your first product to get started" class="mt-4" />
                <div class="mt-4 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg text-center">
                    <p class="text-3xl mb-2">📋</p>
                    <p class="text-sm font-medium text-gray-900 dark:text-white">No Tasks Yet</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Create your first task to get started</p>
                    <button class="mt-3 px-4 py-2 text-sm font-medium bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">+ Create Task</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection