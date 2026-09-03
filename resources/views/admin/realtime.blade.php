@extends('layouts.admin')

@section('title', 'Real-time')

@section('breadcrumb')
<div class="mb-4">
    <x-navigation.breadcrumb :items="[
        ['label' => 'Home', 'href' => '/admin', 'icon' => '🏠'],
        ['label' => 'Analytics'],
        ['label' => 'Real-time'],
    ]" separator="chevron" />
</div>
@endsection

@section('content')
<div class="space-y-6">
    <x-layout.page-header title="Real-time" description="Pantau aktivitas secara langsung." />

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        <x-data.stat-card label="Online Sekarang" value="342" icon="🟢" trend="+15" :trendUp="true" />
        <x-data.stat-card label="Aksi / menit" value="1,204" icon="⚡" trend="+4.2%" :trendUp="true" />
        <x-data.stat-card label="Latensi" value="42ms" icon="📡" trend="-3ms" :trendUp="true" />
    </div>

    <x-data.charts
        type="line"
        label="Aktivitas Pengguna (Live)"
        labels='["10:00","10:05","10:10","10:15","10:20","10:25"]'
        datasets='[{"label":"Request","data":[120,210,180,320,290,410],"borderColor":"rgb(59,130,246)","backgroundColor":"rgba(59,130,246,0.15)","fill":true,"tension":0.4,"pointRadius":4},{"label":"Error","data":[5,8,3,12,6,9],"borderColor":"rgb(239,68,68)","backgroundColor":"rgba(239,68,68,0.1)","fill":true,"tension":0.4,"pointRadius":4}]'
        height="320px"
    />
</div>
@endsection