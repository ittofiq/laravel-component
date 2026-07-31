@extends('layouts.app')
@section('title', 'Data Components - BacaDev')
@section('content')
<div class="flex min-h-screen">
    @include('pages.components.sidebar', ['currentCategory' => 'data'])
    <div class="flex-1 min-w-0 px-4 py-8">
        <h1 class="text-3xl font-bold mb-2 text-gray-900 dark:text-white">📊 Data Components</h1>
        <p class="text-gray-600 dark:text-gray-400 mb-8">9 komponen: Table, Advanced Table, Timeline, Kanban, Calendar, Progress Bar, Stat Card, Charts (Chart.js), Card Grid</p>
        <div class="grid grid-cols-1 gap-6">
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Advanced Table</h3>
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
                        ['name' => 'Diana Evans', 'email' => 'diana@example.com', 'role' => 'Viewer', 'status' => 'Active'],
                        ['name' => 'Frank Green', 'email' => 'frank@example.com', 'role' => 'Editor', 'status' => 'Inactive'],
                        ['name' => 'Grace Hill', 'email' => 'grace@example.com', 'role' => 'Admin', 'status' => 'Active'],
                        ['name' => 'Henry Irving', 'email' => 'henry@example.com', 'role' => 'Viewer', 'status' => 'Pending'],
                        ['name' => 'Ivy Jones', 'email' => 'ivy@example.com', 'role' => 'Editor', 'status' => 'Active'],
                    ]"
                    :striped="true"
                    :searchable="true"
                    :sortable="true"
                    :paginate="5"
                    :crud="true"
                    :create="true"
                    :export="true"
                    :print="true"
                    createLabel="Add User"
                    searchPlaceholder="Search name, email, role..."
                />
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Simple Table</h3>
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-3">Minimal — no search, no pagination, no CRUD, no stripe</p>
                <x-data.table
                    :headers="[['key' => 'id', 'label' => 'ID'], ['key' => 'product', 'label' => 'Product'], ['key' => 'price', 'label' => 'Price'], ['key' => 'stock', 'label' => 'Stock']]"
                    :rows="[
                        ['id' => '#001', 'product' => 'Laptop', 'price' => '$999', 'stock' => 'In Stock'],
                        ['id' => '#002', 'product' => 'Monitor', 'price' => '$349', 'stock' => 'Low'],
                        ['id' => '#003', 'product' => 'Keyboard', 'price' => '$89', 'stock' => 'Out'],
                    ]"
                    :striped="false"
                    :searchable="false"
                    :paginate="false"
                />
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Compact Table</h3>
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-3">Small rows — export + print, no CRUD</p>
                <x-data.table
                    :headers="[['key' => 'date', 'label' => 'Date'], ['key' => 'amount', 'label' => 'Amount'], ['key' => 'status', 'label' => 'Status', 'badge' => true], ['key' => 'method', 'label' => 'Method']]"
                    :rows="[
                        ['date' => '2024-01-15', 'amount' => '$150.00', 'status' => 'Active', 'method' => 'Credit Card'],
                        ['date' => '2024-01-20', 'amount' => '$89.99', 'status' => 'Pending', 'method' => 'PayPal'],
                        ['date' => '2024-02-01', 'amount' => '$250.00', 'status' => 'Active', 'method' => 'Bank Transfer'],
                        ['date' => '2024-02-10', 'amount' => '$45.00', 'status' => 'Inactive', 'method' => 'Cash'],
                    ]"
                    :striped="true"
                    :searchable="false"
                    :paginate="false"
                    :export="true"
                    :print="true"
                />
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Dashboard Table</h3>
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-3">No toolbar — search only, compact view</p>
                <x-data.table
                    title="Recent Orders"
                    :headers="[['key' => 'order', 'label' => 'Order'], ['key' => 'customer', 'label' => 'Customer'], ['key' => 'total', 'label' => 'Total'], ['key' => 'status', 'label' => 'Status', 'badge' => true]]"
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
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Calendar</h3>
                <x-data.calendar :events="[
                    ['date' => '2026-07-15', 'label' => 'Team Meeting', 'color' => 'blue'],
                    ['date' => '2026-07-22', 'label' => 'Deadline', 'color' => 'red'],
                    ['date' => '2026-07-28', 'label' => 'Lunch', 'color' => 'green'],
                ]" />
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Timeline</h3>
                <x-data.timeline :items="[
                    ['title' => 'Project Kickoff', 'date' => 'Jan 2024', 'content' => 'Initial planning and team setup', 'icon' => '🚀', 'color' => 'blue'],
                    ['title' => 'Design Phase', 'date' => 'Mar 2024', 'content' => 'UI/UX design completed', 'icon' => '🎨', 'color' => 'purple'],
                    ['title' => 'Development', 'date' => 'Jun 2024', 'content' => 'Core features implemented', 'icon' => '💻', 'color' => 'orange'],
                    ['title' => 'Beta Launch', 'date' => 'Sep 2024', 'content' => 'First beta version released to testers', 'icon' => '🧪', 'color' => 'green'],
                    ['title' => 'Production', 'date' => 'Dec 2024', 'content' => 'V1.0 shipped to production', 'icon' => '🎉', 'color' => 'red'],
                ]" />
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Kanban</h3>
                <x-data.kanban :columns="[['title' => 'To Do', 'items' => [['title' => 'Task 1', 'description' => 'Do something', 'priority' => 'High', 'assignee' => 'John']]], ['title' => 'In Progress', 'items' => [['title' => 'Task 2', 'description' => 'Do another', 'priority' => 'Medium', 'assignee' => 'Jane']]], ['title' => 'Done', 'items' => []]]" />
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Progress Bar</h3>
                    <div class="space-y-4">
                        <x-data.progress-bar :percent="60" showLabel />
                        <x-data.progress-bar :percent="85" color="green" />
                        <x-data.progress-bar :percent="45" color="purple" :striped="true" />
                        <x-data.progress-bar :percent="70" color="indigo" :animated="true" />
                        <x-data.progress-bar :percent="90" color="red" size="lg" :labelInside="true" />
                    </div>
                </div>
                <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Stat Card</h3>
                    <div class="grid grid-cols-2 gap-3">
                        <x-data.stat-card label="Users" value="1.2K" icon="👥" />
                        <x-data.stat-card label="Revenue" value="$12K" icon="💰" />
                    </div>
                </div>
            </div>
            {{-- Charts --}}
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow">
                <h3 class="font-bold mb-4 text-gray-900 dark:text-white">Charts (Chart.js)</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">
                    <x-data.charts
                        type="bar"
                        label="Monthly Sales"
                        labels='["Jan","Feb","Mar","Apr","Mei","Jun"]'
                        datasets='[{"label":"2026","data":[65,59,80,81,56,90],"backgroundColor":"rgba(59,130,246,0.7)","borderColor":"rgb(59,130,246)","borderWidth":1,"borderRadius":6},{"label":"2025","data":[45,40,55,60,35,70],"backgroundColor":"rgba(156,163,175,0.5)","borderColor":"rgb(156,163,175)","borderWidth":1,"borderRadius":6}]'
                        height="280px"
                    />
                    <x-data.charts
                        type="line"
                        label="User Growth"
                        labels='["Jan","Feb","Mar","Apr","Mei","Jun"]'
                        datasets='[{"label":"Active Users","data":[120,190,310,500,780,1100],"borderColor":"rgb(34,197,94)","backgroundColor":"rgba(34,197,94,0.1)","fill":true,"tension":0.4,"pointRadius":4,"pointHoverRadius":6}]'
                        height="280px"
                    />
                    <x-data.charts
                        type="doughnut"
                        label="Traffic Sources"
                        labels='["Organic","Direct","Social","Referral","Email"]'
                        datasets='[{"data":[35,25,20,12,8],"backgroundColor":["rgba(59,130,246,0.8)","rgba(34,197,94,0.8)","rgba(168,85,247,0.8)","rgba(249,115,22,0.8)","rgba(239,68,68,0.8)"],"borderWidth":0}]'
                        height="280px"
                    />
                    <x-data.charts
                        type="radar"
                        label="Skill Assessment"
                        labels='["Speed","Reliability","Design","UX","SEO","Content"]'
                        datasets='[{"label":"Team A","data":[85,70,90,65,75,80],"borderColor":"rgb(59,130,246)","backgroundColor":"rgba(59,130,246,0.2)","pointBackgroundColor":"rgb(59,130,246)"},{"label":"Team B","data":[70,90,65,80,85,70],"borderColor":"rgb(239,68,68)","backgroundColor":"rgba(239,68,68,0.2)","pointBackgroundColor":"rgb(239,68,68)"}]'
                        height="280px"
                    />
                </div>
            </div>
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow"><h3 class="font-bold mb-4 text-gray-900 dark:text-white">Card Grid</h3>
                <x-data.card-grid title="Product Name" price="99.99" image="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='200'%3E%3Crect fill='%23e5e7eb' width='300' height='200'/%3E%3C/svg%3E" :rating="4" />
            </div>
        </div>
    </div>
</div>
@endsection
