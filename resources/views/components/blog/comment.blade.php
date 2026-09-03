{{-- Komponen Comment — satu komentar (avatar + nama + waktu + isi + balas + replies) --}}
@props([
    'name' => '',
    'avatar' => null,
    'time' => null,
    'text' => '',
    'author' => false,   // true bila ini komentar penulis artikel
    'replyable' => true, // tampilkan tombol + form balas
])

<div x-data="{ showReply: false }" class="flex gap-3">
    {{-- Avatar --}}
    @if($avatar)
        <img src="{{ $avatar }}" alt="{{ $name }}" class="w-9 h-9 rounded-full object-cover flex-shrink-0" />
    @else
        <div class="w-9 h-9 rounded-full bg-gray-500 flex items-center justify-center text-white text-xs font-bold flex-shrink-0">{{ strtoupper(substr($name, 0, 2)) }}</div>
    @endif

    <div class="flex-1 min-w-0">
        {{-- Header --}}
        <div class="flex items-center gap-2 flex-wrap">
            <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $name }}</span>
            @if($author)
                <span class="text-[10px] font-semibold px-1.5 py-0.5 rounded-full bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300">Penulis</span>
            @endif
            @if($time)
                <span class="text-xs text-gray-400 dark:text-gray-500">{{ $time }}</span>
            @endif
        </div>

        {{-- Isi --}}
        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $text }}</p>

        {{-- Tombol Balas --}}
        @if($replyable)
            <button @click="showReply = !showReply" class="text-xs font-medium text-gray-400 hover:text-blue-500 mt-1.5 transition-colors" x-text="showReply ? 'Batal' : 'Balas'">Balas</button>

            {{-- Form balas --}}
            <div x-show="showReply" x-collapse class="mt-3">
                <form @submit.prevent="showReply = false" class="flex gap-2">
                    <input type="text" placeholder="Tulis balasan..." class="flex-1 px-3 py-1.5 text-sm rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition" />
                    <button type="submit" class="px-3 py-1.5 text-sm font-medium bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition flex-shrink-0">Kirim</button>
                </form>
            </div>
        @endif

        {{-- Balasan (nested replies) --}}
        @if(isset($replies) && $replies->isNotEmpty())
            <div class="mt-4 pl-4 sm:pl-6 border-l-2 border-gray-100 dark:border-gray-700 space-y-4">
                {{ $replies }}
            </div>
        @endif
    </div>
</div>