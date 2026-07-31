{{-- Komponen User Profile Card --}}
@props([
    'avatar' => null,
    'name' => 'User',
    'email' => null,
    'role' => null,
    'location' => null,
    'bio' => null,
    'stats' => [],       // [['label' => 'Posts', 'value' => 42], ...]
    'socialLinks' => [], // [['icon' => '🐙', 'href' => '#', 'label' => 'GitHub'], ...]
    'coverImage' => null,
])

<div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow overflow-hidden">
    {{-- Cover Image --}}
    @if($coverImage)
        <div class="h-32 bg-cover bg-center" style="background-image: url('{{ $coverImage }}')"></div>
    @else
        <div class="h-24 bg-gradient-to-r from-blue-500 to-purple-600"></div>
    @endif

    {{-- Avatar + Info --}}
    <div class="px-5 pb-5 {{ $coverImage ? '-mt-10' : '-mt-12' }}">
        <div class="flex justify-center">
            @if($avatar)
                <img src="{{ $avatar }}" alt="{{ $name }}" class="w-20 h-20 rounded-full border-4 border-white dark:border-gray-800 object-cover shadow" />
            @else
                <div class="w-20 h-20 rounded-full border-4 border-white dark:border-gray-800 bg-blue-500 text-white flex items-center justify-center text-2xl font-bold shadow">
                    {{ strtoupper(substr($name, 0, 2)) }}
                </div>
            @endif
        </div>

        <div class="text-center mt-3">
            <h3 class="text-lg font-bold text-gray-900 dark:text-white">{{ $name }}</h3>
            @if($role)
                <p class="text-sm text-blue-500 dark:text-blue-400 font-medium">{{ $role }}</p>
            @endif
            @if($email)
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">{{ $email }}</p>
            @endif
            @if($location)
                <p class="text-xs text-gray-400 dark:text-gray-500 mt-0.5">📍 {{ $location }}</p>
            @endif
        </div>

        {{-- Bio --}}
        @if($bio)
            <p class="text-sm text-gray-600 dark:text-gray-400 text-center mt-3 leading-relaxed">{{ $bio }}</p>
        @endif

        {{-- Stats --}}
        @if(count($stats) > 0)
            <div class="flex justify-center gap-6 mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                @foreach($stats as $stat)
                    <div class="text-center">
                        <p class="text-lg font-bold text-gray-900 dark:text-white">{{ $stat['value'] }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $stat['label'] }}</p>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Social Links --}}
        @if(count($socialLinks) > 0)
            <div class="flex justify-center gap-3 mt-4 pt-3 border-t border-gray-100 dark:border-gray-700">
                @foreach($socialLinks as $link)
                    <a href="{{ $link['href'] ?? '#' }}" class="w-9 h-9 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center text-lg hover:bg-gray-200 dark:hover:bg-gray-600 transition" title="{{ $link['label'] ?? '' }}">
                        {{ $link['icon'] ?? '🔗' }}
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</div>