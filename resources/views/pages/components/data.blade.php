@extends('layouts.app')
@section('title', 'Data Components - BacaDev')
@section('content')
<div class="flex min-h-screen">
    @include('pages.components.sidebar', ['currentCategory' => 'data'])
    <div class="flex-1 min-w-0 px-4 py-8">
        <h1 class="text-3xl font-bold mb-2 text-gray-900 dark:text-white">📊 Data Components</h1>
        <p class="text-gray-600 dark:text-gray-400 mb-8">9 komponen: Table, Advanced Table, Timeline, Kanban, Calendar, Progress Bar, Stat Card, Charts (Chart.js), Card Grid</p>
        <div class="grid grid-cols-1 gap-6">

            <x-ui.demo-card title="Advanced Table" component="data.table" :props="[
                ['name' => 'headers', 'type' => 'array', 'default' => '[]', 'description' => 'Kolom: key, label, sortable, badge'],
                ['name' => 'rows', 'type' => 'array', 'default' => '[]', 'description' => 'Data baris'],
                ['name' => 'searchable', 'type' => 'bool', 'default' => 'true', 'description' => 'Tampilkan pencarian'],
                ['name' => 'sortable', 'type' => 'bool', 'default' => 'true', 'description' => 'Sorting klik header'],
                ['name' => 'striped', 'type' => 'bool', 'default' => 'true', 'description' => 'Baris selang-seling'],
                ['name' => 'paginate', 'type' => 'int|bool', 'default' => '5', 'description' => 'Jumlah per halaman (false = off)'],
                ['name' => 'crud', 'type' => 'bool', 'default' => 'false', 'description' => 'Aksi view/edit/delete'],
                ['name' => 'export', 'type' => 'bool', 'default' => 'false', 'description' => 'Tombol export CSV'],
                ['name' => 'print', 'type' => 'bool', 'default' => 'false', 'description' => 'Tombol cetak'],
            ]">
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-4">Search, sort (klik header), pagination, striped rows, CRUD actions</p>
                <x-data.table
                    :headers="[
                        ['key' => 'name', 'label' => 'Name', 'sortable' => true],
                        ['key' => 'email', 'label' => 'Email', 'sortable' => true],
                        ['key' => 'role', 'label' => 'Role', 'sortable' => true, 'badge' => true],
                        ['key' => 'status', 'label' => 'Status', 'sortable' => true, 'badge' => true],
                    ]"
                    :rows="[
                        ['name' => 'John Doe', 'email' => 'john@example.com', 'role' => 'Admin', 'status' => 'Active'],
                        ['name' => 'Jane Smith', 'email' => 'jane@example.com', 'role' => 'Editor', 'status' => 'Active'],
                        ['name' => 'Bob Johnson', 'email' => 'bob@example.com', 'role' => 'Viewer', 'status' => 'Inactive'],
                        ['name' => 'Alice Brown', 'email' => 'alice@example.com', 'role' => 'Editor', 'status' => 'Active'],
                        ['name' => 'Charlie Davis', 'email' => 'charlie@example.com', 'role' => 'Admin', 'status' => 'Pending'],
                    ]"
                    :striped="true" :searchable="true" :sortable="true" :paginate="5"
                    :crud="true" :create="true" :export="true" :print="true"
                    createLabel="Add User" searchPlaceholder="Search name, email, role..."
                />
            </x-ui.demo-card>

            <x-ui.demo-card title="Timeline" component="data.timeline" :props="[
                ['name' => 'items', 'type' => 'array', 'default' => '[]', 'description' => 'Event: title, date, content, icon, color'],
            ]">
                <x-data.timeline :items="[
                    ['title' => 'Project Kickoff', 'date' => 'Jan 2024', 'content' => 'Initial planning and team setup', 'icon' => '🚀', 'color' => 'blue'],
                    ['title' => 'Design Phase', 'date' => 'Mar 2024', 'content' => 'UI/UX design completed', 'icon' => '🎨', 'color' => 'purple'],
                    ['title' => 'Beta Launch', 'date' => 'Sep 2024', 'content' => 'First beta version released to testers', 'icon' => '🧪', 'color' => 'green'],
                ]" />
            </x-ui.demo-card>

            <x-ui.demo-card title="Kanban" component="data.kanban" :props="[
                ['name' => 'columns', 'type' => 'array', 'default' => '[]', 'description' => 'Kolom: title + items (title, description, priority, assignee)'],
            ]">
                <x-data.kanban :columns="[
                    ['title' => 'To Do', 'items' => [['title' => 'Task 1', 'description' => 'Do something', 'priority' => 'High', 'assignee' => 'John']]],
                    ['title' => 'In Progress', 'items' => [['title' => 'Task 2', 'description' => 'Do another', 'priority' => 'Medium', 'assignee' => 'Jane']]],
                    ['title' => 'Done', 'items' => []],
                ]" />
            </x-ui.demo-card>

            <x-ui.demo-card title="Calendar" component="data.calendar" :props="[
                ['name' => 'events', 'type' => 'array', 'default' => '[]', 'description' => 'Event: date, label, color'],
                ['name' => 'year', 'type' => 'int|null', 'default' => 'null', 'description' => 'Tahun (default: sekarang)'],
                ['name' => 'month', 'type' => 'int|null', 'default' => 'null', 'description' => 'Bulan 1-12 (default: sekarang)'],
            ]">
                <x-data.calendar :events="[
                    ['date' => '2026-07-15', 'label' => 'Team Meeting', 'color' => 'blue'],
                    ['date' => '2026-07-22', 'label' => 'Deadline', 'color' => 'red'],
                    ['date' => '2026-07-28', 'label' => 'Lunch', 'color' => 'green'],
                ]" />
            </x-ui.demo-card>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 mt-6">

            <x-ui.demo-card title="Progress Bar" component="data.progress-bar" :props="[
                ['name' => 'percent', 'type' => 'int', 'default' => '0', 'description' => 'Persentase 0-100'],
                ['name' => 'color', 'type' => 'string', 'default' => '\'blue\'', 'description' => 'Warna bar'],
                ['name' => 'size', 'type' => 'string', 'default' => '\'md\'', 'description' => 'xs, sm, md, lg, xl'],
                ['name' => 'striped', 'type' => 'bool', 'default' => 'false', 'description' => 'Pola garis'],
                ['name' => 'animated', 'type' => 'bool', 'default' => 'false', 'description' => 'Animasi bergerak'],
                ['name' => 'labelInside', 'type' => 'bool', 'default' => 'false', 'description' => 'Label di dalam bar'],
                ['name' => 'showLabel', 'type' => 'bool', 'default' => 'true', 'description' => 'Tampilkan label persen'],
            ]">
                <x-data.progress-bar :percent="60" showLabel />
                <x-data.progress-bar :percent="85" color="green" class="mt-3" />
                <x-data.progress-bar :percent="45" color="purple" :striped="true" class="mt-3" />
                <x-data.progress-bar :percent="70" color="indigo" :animated="true" class="mt-3" />
                <x-data.progress-bar :percent="90" color="red" size="lg" :labelInside="true" class="mt-3" />
                <div class="mt-4">
                    <p class="text-xs font-semibold text-gray-600 dark:text-gray-400 mb-2">Sizes</p>
                    <div class="space-y-2">
                        <x-data.progress-bar :percent="60" size="xs" />
                        <x-data.progress-bar :percent="60" size="sm" />
                        <x-data.progress-bar :percent="60" size="md" />
                        <x-data.progress-bar :percent="60" size="lg" />
                        <x-data.progress-bar :percent="60" size="xl" />
                    </div>
                </div>
            </x-ui.demo-card>

            <x-ui.demo-card title="Stat Card" component="data.stat-card" :props="[
                ['name' => 'label', 'type' => 'string', 'default' => '\'Statistic\'', 'description' => 'Label statistik'],
                ['name' => 'value', 'type' => 'string', 'default' => '\'0\'', 'description' => 'Nilai'],
                ['name' => 'icon', 'type' => 'string', 'default' => '\'📊\'', 'description' => 'Emoji/ikon'],
                ['name' => 'trend', 'type' => 'string|null', 'default' => 'null', 'description' => 'Teks trend (+12% dsb.)'],
                ['name' => 'trendUp', 'type' => 'bool', 'default' => 'true', 'description' => 'Arah trend naik/turun'],
            ]">
                <div class="grid grid-cols-2 gap-3">
                    <x-data.stat-card label="Users" value="1.2K" icon="👥" />
                    <x-data.stat-card label="Revenue" value="$12K" icon="💰" />
                </div>
            </x-ui.demo-card>

            <x-ui.demo-card title="Card Grid" component="data.card-grid" :props="[
                ['name' => 'title', 'type' => 'string', 'default' => '\'Product Name\'', 'description' => 'Judul produk'],
                ['name' => 'price', 'type' => 'string', 'default' => '\'0.00\'', 'description' => 'Harga'],
                ['name' => 'image', 'type' => 'string|null', 'default' => 'null', 'description' => 'URL gambar'],
                ['name' => 'rating', 'type' => 'int', 'default' => '5', 'description' => 'Rating 1-5'],
            ]">
                <x-data.card-grid title="Product Name" price="99.99" image="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='200'%3E%3Crect fill='%23e5e7eb' width='300' height='200'/%3E%3C/svg%3E" :rating="4" />
            </x-ui.demo-card>

        </div>

        <div class="grid grid-cols-1 gap-6 mt-6">

            <x-ui.demo-card title="Charts (Chart.js)" component="data.charts" :props="[
                ['name' => 'type', 'type' => 'string', 'default' => '\'bar\'', 'description' => 'bar, line, pie, doughnut, radar, polarArea'],
                ['name' => 'label', 'type' => 'string', 'default' => '\'Chart\'', 'description' => 'Judul chart'],
                ['name' => 'labels', 'type' => 'string', 'default' => '\'[]\'', 'description' => 'JSON label sumbu'],
                ['name' => 'datasets', 'type' => 'string', 'default' => '\'[]\'', 'description' => 'JSON dataset'],
                ['name' => 'options', 'type' => 'string', 'default' => '\'{}\'', 'description' => 'Override opsi Chart.js'],
                ['name' => 'height', 'type' => 'string', 'default' => '\'320px\'', 'description' => 'Tinggi container'],
            ]">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-data.charts type="bar" label="Monthly Sales" labels='["Jan","Feb","Mar","Apr","Mei","Jun"]' datasets='[{"label":"2026","data":[65,59,80,81,56,90],"backgroundColor":"rgba(59,130,246,0.7)","borderColor":"rgb(59,130,246)","borderWidth":1,"borderRadius":6}]' height="280px" />
                    <x-data.charts type="line" label="User Growth" labels='["Jan","Feb","Mar","Apr","Mei","Jun"]' datasets='[{"label":"Active Users","data":[120,190,310,500,780,1100],"borderColor":"rgb(34,197,94)","backgroundColor":"rgba(34,197,94,0.1)","fill":true,"tension":0.4}]' height="280px" />
                    <x-data.charts type="doughnut" label="Traffic Sources" labels='["Organic","Direct","Social","Referral","Email"]' datasets='[{"data":[35,25,20,12,8],"backgroundColor":["rgba(59,130,246,0.8)","rgba(34,197,94,0.8)","rgba(168,85,247,0.8)"],"borderWidth":0}]' height="280px" />
                    <x-data.charts type="radar" label="Skill Assessment" labels='["Speed","Reliability","Design","UX","SEO","Content"]' datasets='[{"label":"Team A","data":[85,70,90,65,75,80],"borderColor":"rgb(59,130,246)","backgroundColor":"rgba(59,130,246,0.2)"}]' height="280px" />
                </div>
            </x-ui.demo-card>

        </div>
    </div>
</div>
@endsection