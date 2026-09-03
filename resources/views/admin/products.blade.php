@extends('layouts.admin')

@section('title', 'Products')

@section('breadcrumb')
<div class="mb-4">
    <x-navigation.breadcrumb :items="[
        ['label' => 'Home', 'href' => '/admin', 'icon' => '🏠'],
        ['label' => 'Products'],
    ]" separator="chevron" />
</div>
@endsection

@section('content')
<div class="space-y-6">
    <x-layout.page-header title="Products" description="Kelola katalog produk Anda." />

    {{-- Stat cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <x-data.stat-card label="Total Produk" value="1,240" icon="📦" trend="+3.1%" :trendUp="true" />
        <x-data.stat-card label="Stok Menipis" value="45" icon="⚠️" trend="-2.4%" :trendUp="false" />
        <x-data.stat-card label="Nonaktif" value="12" icon="🚫" trend="+0.5%" :trendUp="true" />
    </div>

    {{-- Products table --}}
    <x-data.table
        title="Daftar Produk"
        :headers="[
            ['key' => 'product', 'label' => 'Produk'],
            ['key' => 'category', 'label' => 'Kategori'],
            ['key' => 'price', 'label' => 'Harga'],
            ['key' => 'status', 'label' => 'Status', 'badge' => true],
        ]"
        :rows="[
            ['product' => 'Laptop Pro 16 inch', 'category' => 'Elektronik', 'price' => '$1,299', 'status' => 'Active'],
            ['product' => 'Wireless Mouse', 'category' => 'Aksesoris', 'price' => '$49', 'status' => 'Active'],
            ['product' => 'Monitor 27 inch', 'category' => 'Elektronik', 'price' => '$349', 'status' => 'Draft'],
            ['product' => 'Mechanical Keyboard', 'category' => 'Aksesoris', 'price' => '$129', 'status' => 'Active'],
            ['product' => 'USB-C Hub', 'category' => 'Aksesoris', 'price' => '$79', 'status' => 'Inactive'],
            ['product' => 'Webcam HD', 'category' => 'Elektronik', 'price' => '$89', 'status' => 'Active'],
        ]"
        :searchable="true"
        :sortable="true"
        :striped="true"
        :paginate="6"
        :create="true"
        createLabel="Tambah Produk"
    />
</div>
@endsection