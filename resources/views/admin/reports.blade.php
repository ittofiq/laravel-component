@extends('layouts.admin')

@section('title', 'Reports')

@section('breadcrumb')
<div class="mb-4">
    <x-navigation.breadcrumb :items="[
        ['label' => 'Home', 'href' => '/admin', 'icon' => '🏠'],
        ['label' => 'Analytics'],
        ['label' => 'Reports'],
    ]" separator="chevron" />
</div>
@endsection

@section('content')
<div class="space-y-6">
    <x-layout.page-header title="Reports" description="Laporan performa aplikasi Anda." />

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <x-data.charts
            type="bar"
            label="Penjualan Bulanan"
            labels='["Jan","Feb","Mar","Apr","Mei","Jun"]'
            datasets='[{"label":"2026","data":[65,59,80,81,56,90],"backgroundColor":"rgba(59,130,246,0.7)","borderColor":"rgb(59,130,246)","borderWidth":1,"borderRadius":6}]'
            height="280px"
        />
        <x-data.charts
            type="line"
            label="Pengunjung"
            labels='["Jan","Feb","Mar","Apr","Mei","Jun"]'
            datasets='[{"label":"Sesi","data":[120,190,310,500,780,1100],"borderColor":"rgb(34,197,94)","backgroundColor":"rgba(34,197,94,0.1)","fill":true,"tension":0.4}]'
            height="280px"
        />
        <x-data.charts
            type="doughnut"
            label="Sumber Trafik"
            labels='["Organic","Direct","Social","Referral"]'
            datasets='[{"data":[35,25,20,20],"backgroundColor":["rgba(59,130,246,0.8)","rgba(34,197,94,0.8)","rgba(168,85,247,0.8)","rgba(249,115,22,0.8)"],"borderWidth":0}]'
            height="280px"
        />
        <x-data.charts
            type="radar"
            label="Skill Assessment"
            labels='["Speed","Reliability","Design","UX","SEO"]'
            datasets='[{"label":"Tim A","data":[85,70,90,65,75],"borderColor":"rgb(59,130,246)","backgroundColor":"rgba(59,130,246,0.2)"},{"label":"Tim B","data":[70,90,65,80,85],"borderColor":"rgb(239,68,68)","backgroundColor":"rgba(239,68,68,0.2)"}]'
            height="280px"
        />
    </div>
</div>
@endsection