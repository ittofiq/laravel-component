@extends('layouts.admin')

@section('title', 'Users')

@section('breadcrumb')
<div class="mb-4">
    <x-navigation.breadcrumb :items="[
        ['label' => 'Home', 'href' => '/admin', 'icon' => '🏠'],
        ['label' => 'Users'],
    ]" separator="chevron" />
</div>
@endsection

@section('content')
<div class="space-y-6">
    <x-layout.page-header title="Users" description="Daftar pengguna terdaftar di aplikasi." />

    {{-- Stat cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <x-data.stat-card label="Total Pengguna" value="2,450" icon="👥" trend="+8.2%" :trendUp="true" />
        <x-data.stat-card label="Aktif" value="1,890" icon="✅" trend="+5.4%" :trendUp="true" />
        <x-data.stat-card label="Baru (bulan ini)" value="128" icon="🆕" trend="+12.1%" :trendUp="true" />
    </div>

    {{-- Users table --}}
    <x-data.table
        title="Daftar Pengguna"
        :headers="[
            ['key' => 'name', 'label' => 'Nama'],
            ['key' => 'email', 'label' => 'Email'],
            ['key' => 'role', 'label' => 'Role', 'badge' => true],
            ['key' => 'status', 'label' => 'Status', 'badge' => true],
        ]"
        :rows="[
            ['name' => 'John Doe', 'email' => 'john@example.com', 'role' => 'Admin', 'status' => 'Active'],
            ['name' => 'Jane Smith', 'email' => 'jane@example.com', 'role' => 'Editor', 'status' => 'Active'],
            ['name' => 'Bob Johnson', 'email' => 'bob@example.com', 'role' => 'Viewer', 'status' => 'Inactive'],
            ['name' => 'Alice Brown', 'email' => 'alice@example.com', 'role' => 'Editor', 'status' => 'Active'],
            ['name' => 'Charlie Davis', 'email' => 'charlie@example.com', 'role' => 'Admin', 'status' => 'Pending'],
            ['name' => 'Diana Evans', 'email' => 'diana@example.com', 'role' => 'Viewer', 'status' => 'Active'],
            ['name' => 'Frank Green', 'email' => 'frank@example.com', 'role' => 'Editor', 'status' => 'Inactive'],
            ['name' => 'Grace Hill', 'email' => 'grace@example.com', 'role' => 'Admin', 'status' => 'Active'],
        ]"
        :searchable="true"
        :sortable="true"
        :striped="true"
        :paginate="8"
        :create="true"
        createLabel="Tambah User"
    />
</div>
@endsection