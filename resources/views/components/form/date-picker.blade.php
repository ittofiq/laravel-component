{{-- Komponen Date Picker dengan Calendar UI --}}
@props([
    'name' => null,
    'label' => null,
    'value' => null,
    'error' => null,
    'required' => false,
    'disabled' => false,
])

@php
    $uniqueId = 'datepicker-' . uniqid();
@endphp

<div class="flex flex-col gap-2">
    @if($label)
        <label class="text-sm font-medium text-gray-700 dark:text-gray-300 flex items-center gap-1">
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    <div x-data="datePickerComponent('{{ $uniqueId }}', '{{ $value }}', {{ $disabled ? 'true' : 'false' }})" @click.outside="isOpen = false" class="relative">
        <input
            type="hidden"
            id="{{ $uniqueId }}"
            name="{{ $name }}"
            x-model="selectedDate"
        />

        <input
            type="text"
            placeholder="Pilih tanggal..."
            x-model="displayDate"
            @click="isOpen = !isOpen"
            readonly
            class="w-full px-4 py-2 rounded-lg border transition-colors duration-200 focus:outline-none focus:ring-2 cursor-pointer {{ $error ? 'border-red-500 focus:ring-red-500 focus:border-red-500' : 'border-gray-300 dark:border-gray-600 focus:ring-blue-500 focus:border-blue-500' }} bg-white dark:bg-gray-700 text-gray-900 dark:text-white {{ $disabled ? 'opacity-60 cursor-not-allowed' : '' }}"
            {{ $disabled ? 'disabled' : '' }}
        />

        <!-- Calendar Dropdown -->
        <div x-show="isOpen" class="absolute top-full left-0 mt-1 z-50 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg shadow-lg p-4 w-72">
            <!-- Month/Year Navigation -->
            <div class="flex justify-between items-center mb-4">
                <button @click="previousMonth" class="px-2 py-1 hover:bg-gray-100 dark:hover:bg-gray-700 rounded">←</button>
                <div class="text-center font-semibold text-gray-900 dark:text-white">
                    <span x-text="monthNames[currentMonth]"></span>
                    <span x-text="currentYear"></span>
                </div>
                <button @click="nextMonth" class="px-2 py-1 hover:bg-gray-100 dark:hover:bg-gray-700 rounded">→</button>
            </div>

            <!-- Day Headers -->
            <div class="grid grid-cols-7 gap-1 mb-2">
                <template x-for="day in ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']" :key="day">
                    <div class="text-center text-xs font-semibold text-gray-600 dark:text-gray-400 py-1" x-text="day"></div>
                </template>
            </div>

            <!-- Calendar Days -->
            <div class="grid grid-cols-7 gap-1">
                <template x-for="(day, idx) in calendarDays" :key="idx">
                    <button
                        @click="selectDate(day.date)"
                        :disabled="!day.currentMonth"
                        class="p-2 text-sm rounded hover:bg-blue-50 dark:hover:bg-blue-900/30 disabled:opacity-30 disabled:cursor-not-allowed text-gray-900 dark:text-white"
                        :class="day.isToday ? 'border-2 border-blue-500' : day.isSelected ? 'bg-blue-500 text-white font-semibold' : ''"
                        x-text="day.day"
                    ></button>
                </template>
            </div>

            <!-- Today Button -->
            <button @click="today" class="w-full mt-4 px-3 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 text-sm font-semibold">
                Hari Ini
            </button>
        </div>

        @if($error)
            <p class="text-sm text-red-500 flex items-center gap-1 mt-1">
                <span>⚠️</span>
                {{ $error }}
            </p>
        @endif
    </div>
</div>

<script>
function datePickerComponent(uniqueId, initialValue, isDisabled) {
    return {
        uniqueId,
        isDisabled,
        selectedDate: initialValue || '',
        displayDate: initialValue ? new Date(initialValue).toLocaleDateString('id-ID') : '',
        isOpen: false,
        currentMonth: new Date().getMonth(),
        currentYear: new Date().getFullYear(),
        monthNames: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],

        get calendarDays() {
            const firstDay = new Date(this.currentYear, this.currentMonth, 1);
            const lastDay = new Date(this.currentYear, this.currentMonth + 1, 0);
            const prevLastDay = new Date(this.currentYear, this.currentMonth, 0);

            const days = [];
            const startDate = firstDay.getDay();
            const endDate = lastDay.getDate();
            const prevDays = prevLastDay.getDate();

            for (let i = startDate - 1; i >= 0; i--) {
                days.push({ day: prevDays - i, date: null, currentMonth: false, isToday: false, isSelected: false });
            }

            for (let i = 1; i <= endDate; i++) {
                const date = new Date(this.currentYear, this.currentMonth, i);
                const dateStr = date.toISOString().split('T')[0];
                const isToday = dateStr === new Date().toISOString().split('T')[0];
                const isSelected = dateStr === this.selectedDate;

                days.push({ day: i, date: dateStr, currentMonth: true, isToday, isSelected });
            }

            const remainingDays = 42 - days.length;
            for (let i = 1; i <= remainingDays; i++) {
                days.push({ day: i, date: null, currentMonth: false, isToday: false, isSelected: false });
            }

            return days;
        },

        selectDate(date) {
            if (date && !this.isDisabled) {
                this.selectedDate = date;
                this.displayDate = new Date(date).toLocaleDateString('id-ID');
                this.isOpen = false;
            }
        },

        today() {
            const now = new Date().toISOString().split('T')[0];
            this.selectDate(now);
        },

        previousMonth() {
            if (this.currentMonth === 0) {
                this.currentMonth = 11;
                this.currentYear--;
            } else {
                this.currentMonth--;
            }
        },

        nextMonth() {
            if (this.currentMonth === 11) {
                this.currentMonth = 0;
                this.currentYear++;
            } else {
                this.currentMonth++;
            }
        }
    };
}
</script>
