@extends('layouts.admin')

@section('title', 'Orders')

@section('breadcrumb')
<div class="mb-4">
    <x-navigation.breadcrumb :items="[
        ['label' => 'Home', 'href' => '/admin', 'icon' => '🏠'],
        ['label' => 'Orders'],
    ]" separator="chevron" />
</div>
@endsection

@section('content')
<div class="space-y-6">
    <x-layout.page-header title="Orders" description="Pantau semua pesanan masuk." />

    {{-- Stat cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <x-data.stat-card label="Total Order" value="842" icon="🛒" trend="+6.8%" :trendUp="true" />
        <x-data.stat-card label="Revenue" value="$12,430" icon="💰" trend="+12.5%" :trendUp="true" />
        <x-data.stat-card label="Pending" value="15" icon="⏳" trend="-1.2%" :trendUp="false" />
    </div>

    {{-- Orders table --}}
    <x-data.table
        title="Daftar Pesanan"
        :headers="[
            ['key' => 'order', 'label' => 'Order'],
            ['key' => 'customer', 'label' => 'Pelanggan'],
            ['key' => 'total', 'label' => 'Total'],
            ['key' => 'status', 'label' => 'Status', 'badge' => true],
        ]"
        :rows="[
            ['order' => '#ORD-001', 'customer' => 'Acme Corp', 'total' => '$1,200', 'status' => 'Active'],
            ['order' => '#ORD-002', 'customer' => 'Globex', 'total' => '$850', 'status' => 'Pending'],
            ['order' => '#ORD-003', 'customer' => 'Initech', 'total' => '$3,400', 'status' => 'Active'],
            ['order' => '#ORD-004', 'customer' => 'Umbrella', 'total' => '$620', 'status' => 'Inactive'],
            ['order' => '#ORD-005', 'customer' => 'Stark Ind', 'total' => '$2,100', 'status' => 'Pending'],
            ['order' => '#ORD-006', 'customer' => 'Wayne Ent', 'total' => '$1,450', 'status' => 'Active'],
        ]"
        :searchable="true"
        :sortable="true"
        :striped="true"
        :paginate="6"
    />
</div>
@endsection