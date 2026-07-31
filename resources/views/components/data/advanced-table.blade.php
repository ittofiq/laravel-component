{{-- Komponen Advanced Table dengan Sorting, Filtering, Pagination --}}
@props([
    'headers' => [],
    'rows' => [],
    'itemsPerPage' => 10,
])

@php
    $uniqueId = 'table-' . uniqid();
    $headersJson = json_encode($headers);
    $rowsJson = json_encode($rows);
@endphp

<div x-data="advancedTableComponent('{{ $uniqueId }}', {{ $headersJson }}, {{ $rowsJson }}, {{ $itemsPerPage }})" class="flex flex-col gap-4">
    <!-- Search & Filter -->
    <div class="flex gap-2 flex-wrap">
        <input
            type="text"
            placeholder="Cari data..."
            x-model="searchQuery"
            @input="filterAndSort"
            class="flex-1 min-w-48 px-3 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
        />
    </div>

    <!-- Table -->
    <div class="overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
        <table class="w-full bg-white dark:bg-gray-800">
            <thead class="bg-gray-100 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
                <tr>
                    <template x-for="header in headers" :key="header.key">
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-900 dark:text-white">
                            <div class="flex items-center gap-2 cursor-pointer hover:text-blue-600 dark:hover:text-blue-400" @click="sortBy(header.key)">
                                <span x-text="header.label"></span>
                                <span x-show="sortKey === header.key" :class="sortOrder === 'asc' ? '↑' : '↓'"></span>
                            </div>
                        </th>
                    </template>
                </tr>
            </thead>
            <tbody>
                <template x-for="(row, index) in paginatedRows" :key="index">
                    <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50">
                        <template x-for="header in headers" :key="header.key">
                            <td class="px-4 py-3 text-sm text-gray-700 dark:text-gray-300" x-text="row[header.key]"></td>
                        </template>
                    </tr>
                </template>

                <tr x-show="paginatedRows.length === 0">
                    <td :colspan="headers.length" class="px-4 py-8 text-center text-gray-500 dark:text-gray-400">
                        Tidak ada data yang cocok
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Pagination & Info -->
    <div class="flex items-center justify-between text-sm text-gray-600 dark:text-gray-400">
        <span>Menampilkan <span x-text="((currentPage - 1) * itemsPerPage) + 1"></span> - <span x-text="Math.min(currentPage * itemsPerPage, filteredRows.length)"></span> dari <span x-text="filteredRows.length"></span> data</span>

        <div class="flex gap-2">
            <button @click="previousPage" :disabled="currentPage === 1" class="px-3 py-1 rounded border border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed">← Sebelumnya</button>
            <span class="px-3 py-1"><span x-text="currentPage"></span> / <span x-text="totalPages"></span></span>
            <button @click="nextPage" :disabled="currentPage === totalPages" class="px-3 py-1 rounded border border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed">Selanjutnya →</button>
        </div>
    </div>
</div>

<script>
function advancedTableComponent(uniqueId, headers, rows, itemsPerPage) {
    return {
        uniqueId,
        headers,
        allRows: rows,
        filteredRows: rows,
        itemsPerPage,
        searchQuery: '',
        sortKey: null,
        sortOrder: 'asc',
        currentPage: 1,

        get totalPages() {
            return Math.ceil(this.filteredRows.length / this.itemsPerPage);
        },

        get paginatedRows() {
            const start = (this.currentPage - 1) * this.itemsPerPage;
            return this.filteredRows.slice(start, start + this.itemsPerPage);
        },

        filterAndSort() {
            let filtered = this.allRows;

            if (this.searchQuery.trim()) {
                const query = this.searchQuery.toLowerCase();
                filtered = filtered.filter(row =>
                    Object.values(row).some(val =>
                        String(val).toLowerCase().includes(query)
                    )
                );
            }

            if (this.sortKey) {
                filtered.sort((a, b) => {
                    const aVal = a[this.sortKey];
                    const bVal = b[this.sortKey];

                    if (typeof aVal === 'number') {
                        return this.sortOrder === 'asc' ? aVal - bVal : bVal - aVal;
                    }

                    const comparison = String(aVal).localeCompare(String(bVal));
                    return this.sortOrder === 'asc' ? comparison : -comparison;
                });
            }

            this.filteredRows = filtered;
            this.currentPage = 1;
        },

        sortBy(key) {
            if (this.sortKey === key) {
                this.sortOrder = this.sortOrder === 'asc' ? 'desc' : 'asc';
            } else {
                this.sortKey = key;
                this.sortOrder = 'asc';
            }
            this.filterAndSort();
        },

        nextPage() {
            if (this.currentPage < this.totalPages) {
                this.currentPage++;
            }
        },

        previousPage() {
            if (this.currentPage > 1) {
                this.currentPage--;
            }
        }
    };
}
</script>
