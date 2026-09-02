@extends('layouts.admin')

@section('title', 'Dashboard')

@section('breadcrumb')
<div class="mb-4">
    <x-navigation.breadcrumb :items="[
        ['label' => 'Home', 'href' => '/admin', 'icon' => '🏠'],
        ['label' => 'Dashboard'],
    ]" separator="chevron" />
</div>
@endsection

@section('content')
<div class="space-y-6">
    <x-layout.page-header title="Dashboard" description="Ringkasan performa aplikasi Anda.">
        <x-ui.button variant="primary" size="sm">Unduh Laporan</x-ui.button>
        <x-ui.button variant="secondary" size="sm">Refresh</x-ui.button>
    </x-layout.page-header>

    {{-- Stat cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <x-data.stat-card label="Total Revenue" value="$12,430" icon="💰" trend="+12.5%" :trendUp="true" />
        <x-data.stat-card label="Users" value="2,450" icon="👥" trend="+8.2%" :trendUp="true" />
        <x-data.stat-card label="Orders" value="842" icon="🛒" trend="-3.1%" :trendUp="false" />
        <x-data.stat-card label="Conversion" value="3.24%" icon="📈" trend="+0.8%" :trendUp="true" />
    </div>

    {{-- Chart + Recent orders --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-1">
            <x-data.charts
                type="doughnut"
                label="Traffic Sources"
                labels='["Organic","Direct","Social","Referral","Email"]'
                datasets='[{"data":[35,25,20,12,8],"backgroundColor":["rgba(59,130,246,0.8)","rgba(34,197,94,0.8)","rgba(168,85,247,0.8)","rgba(249,115,22,0.8)","rgba(239,68,68,0.8)"],"borderWidth":0}]'
                height="280px"
            />
        </div>
        <div class="lg:col-span-2">
            <x-data.table
                title="Recent Orders"
                :headers="[
                    ['key' => 'order', 'label' => 'Order'],
                    ['key' => 'customer', 'label' => 'Customer'],
                    ['key' => 'total', 'label' => 'Total'],
                    ['key' => 'status', 'label' => 'Status', 'badge' => true],
                ]"
                :rows="[
                    ['order' => '#ORD-001', 'customer' => 'Acme Corp', 'total' => '$1,200', 'status' => 'Active'],
                    ['order' => '#ORD-002', 'customer' => 'Globex', 'total' => '$850', 'status' => 'Pending'],
                    ['order' => '#ORD-003', 'customer' => 'Initech', 'total' => '$3,400', 'status' => 'Active'],
                    ['order' => '#ORD-004', 'customer' => 'Umbrella', 'total' => '$620', 'status' => 'Inactive'],
                    ['order' => '#ORD-005', 'customer' => 'Stark Ind', 'total' => '$2,100', 'status' => 'Pending'],
                ]"
                :searchable="true"
                :striped="true"
                :paginate="3"
                :export="false"
                :print="false"
            />
        </div>
    </div>

    {{-- Revenue chart --}}
    <x-data.charts
        type="bar"
        label="Monthly Revenue"
        labels='["Jan","Feb","Mar","Apr","Mei","Jun"]'
        datasets='[{"label":"2026","data":[65,59,80,81,56,90],"backgroundColor":"rgba(59,130,246,0.7)","borderColor":"rgb(59,130,246)","borderWidth":1,"borderRadius":6},{"label":"2025","data":[45,40,55,60,35,70],"backgroundColor":"rgba(156,163,175,0.5)","borderColor":"rgb(156,163,175)","borderWidth":1,"borderRadius":6}]'
        height="300px"
    />
</div>
@endsection