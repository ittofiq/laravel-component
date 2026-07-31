{{-- Komponen Calendar dengan Alpine.js --}}
@props([
    'events' => [], // [['date' => '2026-07-15', 'label' => 'Meeting', 'color' => 'blue']]
    'year' => null,
    'month' => null,
])

@php
    $now = now();
    $calendarYear = $year ?? (int) $now->format('Y');
    $calendarMonth = $month ?? (int) $now->format('m');
    $eventsJson = json_encode($events);
@endphp

<div
    x-data="calendarComponent({{ $calendarYear }}, {{ $calendarMonth }})"
    x-init='loadEvents({!! $eventsJson !!})'
    class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden"
>
    {{-- Header --}}
    <div class="flex items-center justify-between px-5 py-4 bg-gray-50 dark:bg-gray-700/50 border-b border-gray-200 dark:border-gray-700">
        <button @click="prevMonth" class="p-1.5 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors text-gray-600 dark:text-gray-400">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </button>
        <h3 class="text-lg font-bold text-gray-900 dark:text-white" x-text="monthName + ' ' + year"></h3>
        <button @click="nextMonth" class="p-1.5 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors text-gray-600 dark:text-gray-400">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </button>
    </div>

    {{-- Day Headers --}}
    <div class="grid grid-cols-7 text-center py-3 bg-gray-50 dark:bg-gray-700/30 border-b border-gray-200 dark:border-gray-700">
        <template x-for="day in ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab']" :key="day">
            <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider" x-text="day"></span>
        </template>
    </div>

    {{-- Days Grid --}}
    <div class="grid grid-cols-7 p-2">
        <template x-for="(day, idx) in days" :key="idx">
            <div class="relative aspect-square flex flex-col items-center justify-start pt-1.5 cursor-pointer transition-colors"
                @click="selectDay(day)"
                :class="{
                    'text-gray-400 dark:text-gray-600': !day.currentMonth,
                    'text-gray-900 dark:text-white': day.currentMonth && !day.isToday,
                    'hover:bg-gray-100 dark:hover:bg-gray-700': day.currentMonth,
                    'bg-blue-50 dark:bg-blue-900/20 ring-2 ring-blue-400': day.currentMonth && day.date === selectedDate,
                }"
            >
                {{-- Today indicator --}}
                <span
                    class="inline-flex items-center justify-center w-8 h-8 rounded-full text-sm font-medium transition-all"
                    :class="{
                        'bg-blue-500 text-white shadow-md': day.isToday,
                        '': !day.isToday,
                    }"
                    x-text="day.day"
                ></span>

                {{-- Event dots --}}
                <div class="flex gap-0.5 mt-1" x-show="day.events && day.events.length > 0">
                    <template x-for="event in day.events.slice(0, 3)" :key="event.label">
                        <span
                            class="w-1.5 h-1.5 rounded-full flex-shrink-0"
                            :class="{
                                'bg-blue-400': event.color === 'blue' || !event.color,
                                'bg-green-400': event.color === 'green',
                                'bg-red-400': event.color === 'red',
                                'bg-yellow-400': event.color === 'yellow',
                                'bg-purple-400': event.color === 'purple',
                            }"
                            :title="event.label"
                        ></span>
                    </template>
                    <span x-show="day.events.length > 3" class="text-[10px] text-gray-400 leading-none" x-text="'+' + (day.events.length - 3)"></span>
                </div>
            </div>
        </template>
    </div>

    {{-- Event List --}}
    <div class="border-t border-gray-200 dark:border-gray-700 px-5 py-3 bg-gray-50 dark:bg-gray-700/30" x-show="selectedEvents.length > 0">
        <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 mb-2" x-text="selectedDate"></p>
        <template x-for="event in selectedEvents" :key="event.label">
            <div class="flex items-center gap-2 py-1 text-sm text-gray-700 dark:text-gray-300">
                <span class="w-2 h-2 rounded-full flex-shrink-0"
                    :class="{
                        'bg-blue-400': event.color === 'blue' || !event.color,
                        'bg-green-400': event.color === 'green',
                        'bg-red-400': event.color === 'red',
                        'bg-yellow-400': event.color === 'yellow',
                        'bg-purple-400': event.color === 'purple',
                    }"
                ></span>
                <span x-text="event.label"></span>
            </div>
        </template>
    </div>
</div>

<script>
function calendarComponent(year, month) {
    return {
        year: year,
        month: month,
        events: [],
        days: [],
        selectedDate: '',
        selectedEvents: [],
        monthNames: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],

        get monthName() {
            return this.monthNames[this.month - 1];
        },

        init() {
            this.generateCalendar();
        },

        loadEvents(eventsData) {
            this.events = eventsData || [];
            this.generateCalendar();
        },

        generateCalendar() {
            const firstDay = new Date(this.year, this.month - 1, 1);
            const lastDay = new Date(this.year, this.month, 0);
            const startDay = firstDay.getDay();
            const totalDays = lastDay.getDate();
            const prevMonthDays = new Date(this.year, this.month - 1, 0).getDate();
            const today = new Date();

            this.days = [];

            // Previous month padding
            for (let i = startDay - 1; i >= 0; i--) {
                this.days.push({
                    day: prevMonthDays - i,
                    currentMonth: false,
                    isToday: false,
                    events: []
                });
            }

            // Current month
            for (let d = 1; d <= totalDays; d++) {
                const dateStr = `${this.year}-${String(this.month).padStart(2, '0')}-${String(d).padStart(2, '0')}`;
                const isToday = d === today.getDate() && this.month === today.getMonth() + 1 && this.year === today.getFullYear();
                const dayEvents = (this.events || []).filter(e => e.date === dateStr);
                this.days.push({
                    day: d,
                    currentMonth: true,
                    isToday,
                    date: dateStr,
                    events: dayEvents
                });
            }

            // Next month padding
            const remaining = 42 - this.days.length;
            for (let i = 1; i <= remaining; i++) {
                this.days.push({
                    day: i,
                    currentMonth: false,
                    isToday: false,
                    events: []
                });
            }

            this.selectedEvents = [];
            this.selectedDate = '';
        },

        selectDay(day) {
            if (!day.currentMonth) return;
            this.selectedDate = day.date;
            this.selectedEvents = day.events || [];
        },

        prevMonth() {
            this.month--;
            if (this.month < 1) { this.month = 12; this.year--; }
            this.selectedDate = '';
            this.selectedEvents = [];
            this.generateCalendar();
        },

        nextMonth() {
            this.month++;
            if (this.month > 12) { this.month = 1; this.year++; }
            this.selectedDate = '';
            this.selectedEvents = [];
            this.generateCalendar();
        }
    };
}
</script>
