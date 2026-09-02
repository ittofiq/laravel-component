{{-- Komponen Advanced Table dengan Search, Sort, Pagination, Striped, CRUD --}}
@props([
    'headers' => [],
    'rows' => [],
    'title' => null,
    'searchable' => true,
    'searchPlaceholder' => 'Search...',
    'sortable' => true,
    'striped' => true,
    'paginate' => 5,
    'crud' => false,
    'create' => false,
    'export' => false,
    'print' => false,
    'exportLabel' => 'Export CSV',
    'printLabel' => 'Print',
    'filename' => 'export.csv',
    'createLabel' => 'Create',
    'emptyText' => 'Tidak ada data',
    'viewLabel' => 'View',
    'editLabel' => 'Edit',
    'deleteLabel' => 'Delete',
])

@php
    $rowsJson = json_encode($rows);
    $headersJson = json_encode($headers);
    $itemsPerPage = is_numeric($paginate) ? (int) $paginate : 5;
    $hasPagination = $paginate !== false && $paginate > 0;
    $headerKeys = [];
    $headerLabels = [];
    foreach ($headers as $h) {
        $headerKeys[] = $h['key'] ?? $h;
        $headerLabels[] = $h['label'] ?? $h['key'] ?? $h;
    }
    $headerKeysJs = json_encode($headerKeys);
    $headerLabelsJs = json_encode($headerLabels);
    $tableId = 'table' . str_replace('-', '', uniqid());
@endphp

<div data-table-id="{{ $tableId }}" class="bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-700 shadow">
    {{-- Toolbar --}}
    <div class="px-5 py-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between gap-4 flex-wrap">
        <div class="flex items-center gap-3">
            @if($title)
                <h3 class="text-lg font-bold text-gray-900 dark:text-white">{{ $title }}</h3>
            @endif
            @if($searchable)
                <div class="relative">
                    <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <input type="text" oninput="filterTable(this)" placeholder="{{ $searchPlaceholder }}" class="w-56 pl-9 pr-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 dark:placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" />
                </div>
            @endif
        </div>
        <div class="flex items-center gap-3">
            @if($create)
                <button onclick="openCreateModal('{{ $tableId }}')" class="px-4 py-2 text-sm font-medium bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg> {{ $createLabel }}
                </button>
            @endif
            @if($export)
                <button onclick="exportTableCSV(this)" class="px-4 py-2 text-sm font-medium rounded-lg border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 transition flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg> {{ $exportLabel }}
                </button>
            @endif
            @if($print)
                <button onclick="printTable(this)" class="px-4 py-2 text-sm font-medium rounded-lg border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 transition flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg> {{ $printLabel }}
                </button>
            @endif
        </div>
    </div>

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 dark:bg-gray-800/50 border-b border-gray-200 dark:border-gray-700">
                <tr>
                    @foreach($headers as $header)
                        @php $key = $header['key'] ?? $header; $label = $header['label'] ?? $header; @endphp
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ $label }}</th>
                    @endforeach
                    @if($crud) <th class="px-5 py-3 text-right text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th> @endif
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse($rows as $index => $row)
                    <tr data-row="{{ $index }}" class="table-row-item {{ $striped && $index % 2 === 0 ? 'bg-gray-50 dark:bg-gray-800/50' : '' }} hover:bg-gray-100 dark:hover:bg-gray-700/50 transition-colors" @if($hasPagination && $index >= $itemsPerPage) style="display:none" @endif>
                        @foreach($headers as $header)
                            @php
                                $key = $header['key'] ?? $header;
                                $isBadge = $header['badge'] ?? false;
                                $value = $row[$key] ?? '';
                                $badgeColors = ['Active' => 'green', 'Inactive' => 'gray', 'Pending' => 'yellow', 'Admin' => 'purple', 'Editor' => 'blue', 'Viewer' => 'orange', 'Done' => 'green', 'Draft' => 'gray', 'High' => 'red', 'Medium' => 'yellow', 'Low' => 'green'];
                                $badgeColor = $isBadge ? ($badgeColors[$value] ?? 'gray') : '';
                            @endphp
                            <td class="px-5 py-3 text-sm text-gray-700 dark:text-gray-300">
                                @if($isBadge)
                                    <span class="inline-block px-2.5 py-0.5 text-xs font-medium rounded-full bg-{{ $badgeColor }}-100 text-{{ $badgeColor }}-700 dark:bg-{{ $badgeColor }}-900/30 dark:text-{{ $badgeColor }}-300">{{ $value }}</span>
                                @else
                                    {{ $value }}
                                @endif
                            </td>
                        @endforeach
                        @if($crud)
                            <td class="px-5 py-3 text-right">
                                <div class="flex items-center justify-end gap-1">
                                    <button onclick="openViewModal('{{ $tableId }}', {{ $index }})" class="px-2 py-1.5 text-xs font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 rounded transition" title="{{ $viewLabel }}">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </button>
                                    <button onclick="openEditModal('{{ $tableId }}', {{ $index }})" class="px-2 py-1.5 text-xs font-medium text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded transition" title="{{ $editLabel }}">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </button>
                                    <button onclick="openDeleteModal('{{ $tableId }}', {{ $index }})" class="px-2 py-1.5 text-xs font-medium text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/30 rounded transition" title="{{ $deleteLabel }}">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ count($headers) + ($crud ? 1 : 0) }}" class="px-5 py-12 text-center text-gray-400 dark:text-gray-500">
                            <p class="text-3xl mb-2">📭</p>
                            <p class="text-sm">{{ $emptyText }}</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($hasPagination && count($rows) > $itemsPerPage)
    <div class="px-5 py-3 border-t border-gray-200 dark:border-gray-700 flex items-center justify-between text-sm">
        <span class="text-gray-500 dark:text-gray-400" id="{{ $tableId }}-info">Showing 1–{{ min($itemsPerPage, count($rows)) }} of {{ count($rows) }}</span>
        <div class="flex items-center gap-1" id="{{ $tableId }}-pages">
            <button onclick="paginateTable('{{ $tableId }}', 1)" class="px-2 py-1.5 rounded text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 disabled:opacity-30 disabled:cursor-not-allowed transition">««</button>
            <button onclick="paginateTable('{{ $tableId }}', -1)" class="px-2 py-1.5 rounded text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition">«</button>
            @php $totalPages = ceil(count($rows) / $itemsPerPage); @endphp
            @for($p = 1; $p <= min($totalPages, 5); $p++)
                <button onclick="paginateTable('{{ $tableId }}', {{ $p }})" class="page-btn px-3 py-1.5 rounded text-sm font-medium transition {{ $p === 1 ? 'bg-blue-500 text-white' : 'text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700' }}" data-page="{{ $p }}">{{ $p }}</button>
            @endfor
            @if($totalPages > 5)
                <span class="px-1 text-gray-400">...</span>
                <button onclick="paginateTable('{{ $tableId }}', {{ $totalPages }})" class="page-btn px-3 py-1.5 rounded text-sm font-medium text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition" data-page="{{ $totalPages }}">{{ $totalPages }}</button>
            @endif
            <button onclick="paginateTable('{{ $tableId }}', -2)" class="px-2 py-1.5 rounded text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition">»</button>
            <button onclick="paginateTable('{{ $tableId }}', {{ $totalPages }})" class="px-2 py-1.5 rounded text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 disabled:opacity-30 disabled:cursor-not-allowed transition">»»</button>
        </div>
    </div>
    @endif
</div>

{{-- Modal Overlay --}}
<div id="{{ $tableId }}-overlay" class="fixed inset-0 z-[9999] flex items-center justify-center hidden" onclick="closeModal('{{ $tableId }}')">
    <div class="absolute inset-0 bg-black/50"></div>

    {{-- View Modal --}}
    <div id="{{ $tableId }}-view-modal" class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl border border-gray-200 dark:border-gray-700 p-6 max-w-sm w-full mx-4 hidden" onclick="event.stopPropagation()">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Row Details</h3>
            <button onclick="closeModal('{{ $tableId }}')" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
        </div>
        <div id="{{ $tableId }}-view-content" class="space-y-2"></div>
        <div class="flex justify-end mt-4"><button onclick="closeModal('{{ $tableId }}')" class="px-4 py-2 text-sm font-medium rounded-lg bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 transition">Close</button></div>
    </div>

    {{-- Create Modal --}}
    <div id="{{ $tableId }}-create-modal" class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl border border-gray-200 dark:border-gray-700 p-6 max-w-md w-full mx-4 max-h-[85vh] overflow-y-auto hidden" onclick="event.stopPropagation()">
        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">{{ $createLabel }} New Row</h3>
        <div id="{{ $tableId }}-create-form" class="space-y-3">
            @foreach($headers as $header)
                @php $key = $header['key'] ?? $header; $label = $header['label'] ?? $header; @endphp
                <div><label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">{{ $label }}</label><input type="text" name="{{ $key }}" class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" placeholder="Enter {{ strtolower($label) }}..." /></div>
            @endforeach
        </div>
        <div class="flex justify-end gap-2 mt-5">
            <button onclick="closeModal('{{ $tableId }}')" class="px-4 py-2 text-sm font-medium rounded-lg border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 transition">Cancel</button>
            <button onclick="saveCreate('{{ $tableId }}')" class="px-4 py-2 text-sm font-medium rounded-lg bg-blue-500 text-white hover:bg-blue-600 transition">{{ $createLabel }}</button>
        </div>
    </div>

    {{-- Edit Modal --}}
    <div id="{{ $tableId }}-edit-modal" class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl border border-gray-200 dark:border-gray-700 p-6 max-w-md w-full mx-4 max-h-[85vh] overflow-y-auto hidden" onclick="event.stopPropagation()">
        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">Edit Row</h3>
        <div id="{{ $tableId }}-edit-form" class="space-y-3">
            @foreach($headers as $header)
                @php $key = $header['key'] ?? $header; $label = $header['label'] ?? $header; @endphp
                <div><label class="block text-xs font-medium text-gray-700 dark:text-gray-300 mb-1">{{ $label }}</label><input type="text" name="{{ $key }}" class="w-full px-3 py-2 text-sm rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" /></div>
            @endforeach
        </div>
        <input type="hidden" id="{{ $tableId }}-edit-index" />
        <div class="flex justify-end gap-2 mt-5">
            <button onclick="closeModal('{{ $tableId }}')" class="px-4 py-2 text-sm font-medium rounded-lg border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 transition">Cancel</button>
            <button onclick="saveEdit('{{ $tableId }}')" class="px-4 py-2 text-sm font-medium rounded-lg bg-blue-500 text-white hover:bg-blue-600 transition">Save</button>
        </div>
    </div>

    {{-- Delete Confirm Modal --}}
    <div id="{{ $tableId }}-delete-modal" class="relative bg-white dark:bg-gray-800 rounded-xl shadow-2xl border border-gray-200 dark:border-gray-700 p-6 max-w-sm w-full mx-4 hidden" onclick="event.stopPropagation()">
        <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-2">Confirm Delete</h3>
        <p class="text-sm text-gray-500 dark:text-gray-400 mb-5">Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.</p>
        <input type="hidden" id="{{ $tableId }}-delete-index" />
        <div class="flex justify-end gap-2">
            <button onclick="closeModal('{{ $tableId }}')" class="px-4 py-2 text-sm font-medium rounded-lg border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 transition">Cancel</button>
            <button onclick="confirmDelete('{{ $tableId }}')" class="px-4 py-2 text-sm font-medium rounded-lg bg-red-500 text-white hover:bg-red-600 transition">Delete</button>
        </div>
    </div>
</div>

<script>
(function() {
    var state = {};
    var rows = {!! $rowsJson !!};
    var keys = {!! $headerKeysJs !!};
    var labels = {!! $headerLabelsJs !!};
    var headers = {!! $headersJson !!};
    var id = '{{ $tableId }}';
    var badgeColors = { 'Active': 'green', 'Inactive': 'gray', 'Pending': 'yellow', 'Admin': 'purple', 'Editor': 'blue', 'Viewer': 'orange', 'Done': 'green', 'Draft': 'gray', 'High': 'red', 'Medium': 'yellow', 'Low': 'green' };
    var badgeStyles = { green: { bg: '#dcfce7', text: '#166534' }, gray: { bg: '#f3f4f6', text: '#374151' }, yellow: { bg: '#fef9c3', text: '#854d0e' }, purple: { bg: '#f3e8ff', text: '#6b21a8' }, blue: { bg: '#dbeafe', text: '#1e40af' }, orange: { bg: '#ffedd5', text: '#9a3412' }, red: { bg: '#fee2e2', text: '#991b1b' } };
    state[id] = { page: 1, perPage: {{ $itemsPerPage }}, total: rows.length, rows: rows };

    window.paginateTable = function(id, page) {
        var s = state[id]; if (!s) return;
        if (page === -1) page = Math.max(1, s.page - 1);
        if (page === -2) page = Math.min(Math.ceil(s.total / s.perPage), s.page + 1);
        s.page = Math.max(1, Math.min(Math.ceil(s.total / s.perPage), page));
        var start = (s.page - 1) * s.perPage, end = Math.min(s.page * s.perPage, s.total);
        var container = document.querySelector('[data-table-id="' + id + '"]');
        container.querySelectorAll('.table-row-item').forEach(function(row, i) { row.style.display = (i >= start && i < end) ? '' : 'none'; });
        var info = document.getElementById(id + '-info');
        if (info) info.textContent = 'Showing ' + (start + 1) + '–' + end + ' of ' + s.total;
        container.querySelectorAll('.page-btn').forEach(function(b) { b.classList.remove('bg-blue-500', 'text-white'); b.classList.add('text-gray-500', 'dark:text-gray-400', 'hover:bg-gray-100', 'dark:hover:bg-gray-700'); });
        var active = container.querySelector('.page-btn[data-page="' + s.page + '"]');
        if (active) { active.classList.add('bg-blue-500', 'text-white'); active.classList.remove('text-gray-500', 'dark:text-gray-400', 'hover:bg-gray-100', 'dark:hover:bg-gray-700'); }
    };

    window.filterTable = function(input) {
        var container = input.closest('[data-table-id]'), id = container.getAttribute('data-table-id');
        var q = input.value.toLowerCase(), visible = 0;
        container.querySelectorAll('.table-row-item').forEach(function(row) {
            var match = !q || row.textContent.toLowerCase().indexOf(q) !== -1;
            row.style.display = match ? '' : 'none'; if (match) visible++;
        });
        if (state[id]) { state[id].total = visible; state[id].page = 1; paginateTable(id, 1); }
    };

    // Modal helpers
    window.closeModal = function(id) {
        document.getElementById(id + '-overlay').classList.add('hidden');
        ['view','create','edit','delete'].forEach(function(t) { var el = document.getElementById(id + '-' + t + '-modal'); if (el) el.classList.add('hidden'); });
    };

    window.showModal = function(id, modalId) {
        document.getElementById(id + '-overlay').classList.remove('hidden');
        document.getElementById(id + '-' + modalId).classList.remove('hidden');
    };

    // View
    window.openViewModal = function(id, index) {
        var row = state[id].rows[index], html = '';
        keys.forEach(function(k, i) { html += '<div class="flex justify-between py-1.5 border-b border-gray-100 dark:border-gray-700/50 last:border-0"><span class="text-xs font-medium text-gray-500 dark:text-gray-400">' + labels[i] + '</span><span class="text-sm text-gray-900 dark:text-white">' + (row[k] || '') + '</span></div>'; });
        document.getElementById(id + '-view-content').innerHTML = html;
        showModal(id, 'view-modal');
    };

    // Create
    window.openCreateModal = function(id) {
        document.querySelectorAll('#' + id + '-create-form input').forEach(function(inp) { inp.value = ''; });
        showModal(id, 'create-modal');
    };
    window.saveCreate = function(id) {
        var row = {};
        document.querySelectorAll('#' + id + '-create-form input').forEach(function(inp) { row[inp.name] = inp.value; });
        state[id].rows.push(row); state[id].total = state[id].rows.length; closeModal(id); refreshTable(id);
    };

    // Edit
    window.openEditModal = function(id, index) {
        var row = state[id].rows[index];
        document.querySelectorAll('#' + id + '-edit-form input').forEach(function(inp) { inp.value = row[inp.name] || ''; });
        document.getElementById(id + '-edit-index').value = index;
        showModal(id, 'edit-modal');
    };
    window.saveEdit = function(id) {
        var index = parseInt(document.getElementById(id + '-edit-index').value), row = {};
        document.querySelectorAll('#' + id + '-edit-form input').forEach(function(inp) { row[inp.name] = inp.value; });
        state[id].rows[index] = row; closeModal(id); refreshTable(id);
    };

    // Delete
    window.openDeleteModal = function(id, index) { document.getElementById(id + '-delete-index').value = index; showModal(id, 'delete-modal'); };
    window.confirmDelete = function(id) {
        var index = parseInt(document.getElementById(id + '-delete-index').value);
        state[id].rows.splice(index, 1); state[id].total = state[id].rows.length;
        if (state[id].page > Math.ceil(state[id].total / state[id].perPage)) state[id].page = 1;
        closeModal(id); refreshTable(id); paginateTable(id, state[id].page);
    };

    // Re-render table body
    function refreshTable(id) {
        var container = document.querySelector('[data-table-id="' + id + '"]'), tbody = container.querySelector('tbody');
        var rows = state[id].rows, html = '';
        if (rows.length === 0) {
            var colspan = container.querySelectorAll('thead th').length;
            html = '<tr><td colspan="' + colspan + '" class="px-5 py-12 text-center text-gray-400 dark:text-gray-500"><p class="text-3xl mb-2">📭</p><p class="text-sm">{{ $emptyText }}</p></td></tr>';
        } else {
            rows.forEach(function(row, i) {
                var hidden = (state[id].perPage && i >= state[id].perPage) ? ' style="display:none"' : '';
                var striped = ({{ $striped ? 'true' : 'false' }} && i % 2 === 0) ? ' bg-gray-50 dark:bg-gray-800/50' : '';
                html += '<tr data-row="' + i + '" class="table-row-item' + striped + ' hover:bg-gray-100 dark:hover:bg-gray-700/50 transition-colors"' + hidden + '>';
                keys.forEach(function(k, ki) { var v = row[k] || ''; var isBadge = headers[ki] && headers[ki].badge; if (isBadge) { var bc = badgeColors[v] || 'gray'; html += '<td class="px-5 py-3 text-sm"><span class="inline-block px-2.5 py-0.5 text-xs font-medium rounded-full" style="background:' + badgeStyles[bc].bg + ';color:' + badgeStyles[bc].text + '">' + v + '</span></td>'; } else { html += '<td class="px-5 py-3 text-sm text-gray-700 dark:text-gray-300">' + v + '</td>'; } });
                @if($crud)
                html += '<td class="px-5 py-3 text-right"><div class="flex items-center justify-end gap-1">';
                html += '<button onclick="openViewModal(\'' + id + '\', ' + i + ')" class="px-2 py-1.5 text-xs font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 rounded transition" title="{{ $viewLabel }}"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg></button>';
                html += '<button onclick="openEditModal(\'' + id + '\', ' + i + ')" class="px-2 py-1.5 text-xs font-medium text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded transition" title="{{ $editLabel }}"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></button>';
                html += '<button onclick="openDeleteModal(\'' + id + '\', ' + i + ')" class="px-2 py-1.5 text-xs font-medium text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/30 rounded transition" title="{{ $deleteLabel }}"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>';
                html += '</div></td>';
                @endif
                html += '</tr>';
            });
        }
        tbody.innerHTML = html;
        var info = document.getElementById(id + '-info');
        if (info) info.textContent = 'Showing 1–' + Math.min(state[id].perPage, state[id].total) + ' of ' + state[id].total;
    }
})();

function exportTableCSV(btn) {
    var table = btn.closest('[data-table-id]').querySelector('table'), csv = [];
    table.querySelectorAll('tr').forEach(function(row) {
        var vals = [];
        row.querySelectorAll('th,td').forEach(function(col) { var v = col.textContent.trim(); vals.push(v.indexOf(',') > -1 ? '"' + v.replace(/"/g, '""') + '"' : v); });
        csv.push(vals.join(','));
    });
    var blob = new Blob([csv.join('\n')], { type: 'text/csv;charset=utf-8;' }), url = URL.createObjectURL(blob);
    var a = document.createElement('a'); a.href = url; a.download = '{{ $filename }}'; a.click(); URL.revokeObjectURL(url);
}
function printTable(btn) {
    var table = btn.closest('[data-table-id]').querySelector('table').outerHTML;
    var w = window.open('', '_blank', 'width=800,height=600');
    w.document.write('<!DOCTYPE html><html><head><title>{{ $title ?? 'Table' }}</title></head><body style="padding:20px;font-family:sans-serif">' + table + '</body></html>');
    w.document.close(); w.focus(); setTimeout(function() { w.print(); }, 300);
}
</script>