{{-- Komponen Share Button - Social Share Buttons --}}
@props([
    'url' => null,
    'title' => null,
    'platforms' => ['facebook', 'twitter', 'whatsapp', 'telegram', 'email', 'copy'],
    'variant' => 'inline', // inline, dropdown, minimal
    'label' => 'Share',
    'size' => 'md',
])

@php
    $shareUrl = $url ?? request()->url();
    $shareTitle = $title ?? 'Check this out!';
    $encodedUrl = urlencode($shareUrl);
    $encodedTitle = urlencode($shareTitle);

    $socialLinks = [
        'facebook' => ['url' => "https://www.facebook.com/sharer/sharer.php?u={$encodedUrl}", 'icon' => '📘', 'label' => 'Facebook', 'color' => 'bg-[#1877F2]'],
        'twitter' => ['url' => "https://twitter.com/intent/tweet?url={$encodedUrl}&text={$encodedTitle}", 'icon' => '🐦', 'label' => 'Twitter', 'color' => 'bg-[#1DA1F2]'],
        'whatsapp' => ['url' => "https://wa.me/?text={$encodedTitle}%20{$encodedUrl}", 'icon' => '💬', 'label' => 'WhatsApp', 'color' => 'bg-[#25D366]'],
        'telegram' => ['url' => "https://t.me/share/url?url={$encodedUrl}&text={$encodedTitle}", 'icon' => '📨', 'label' => 'Telegram', 'color' => 'bg-[#26A5E4]'],
        'email' => ['url' => "mailto:?subject={$encodedTitle}&body={$encodedUrl}", 'icon' => '📧', 'label' => 'Email', 'color' => 'bg-gray-500'],
        'copy' => ['url' => '#', 'icon' => '📋', 'label' => 'Copy Link', 'color' => 'bg-gray-600', 'action' => 'copy'],
        'linkedin' => ['url' => "https://www.linkedin.com/sharing/share-offsite/?url={$encodedUrl}", 'icon' => '💼', 'label' => 'LinkedIn', 'color' => 'bg-[#0A66C2]'],
    ];

    $sizeClasses = [
        'sm' => 'w-8 h-8 text-sm',
        'md' => 'w-10 h-10 text-base',
        'lg' => 'w-12 h-12 text-lg',
    ];
    $sizeClass = $sizeClasses[$size] ?? $sizeClasses['md'];
@endphp

@if($variant === 'dropdown')
    <div class="relative inline-block" x-data="{ open: false }">
        <button @click="open = !open" class="px-4 py-2 rounded-lg bg-blue-500 text-white font-medium text-sm hover:bg-blue-600 transition flex items-center gap-2">
            <span>🔗</span> {{ $label }}
        </button>
        <div x-show="open" @click.outside="open = false" x-transition class="absolute top-full left-0 mt-2 bg-white dark:bg-gray-800 rounded-xl shadow-xl border border-gray-200 dark:border-gray-700 p-2 z-50 flex gap-1">
            @foreach($platforms as $platform)
                @if(isset($socialLinks[$platform]))
                    @php $s = $socialLinks[$platform]; @endphp
                    <a href="{{ $s['url'] }}"
                        target="_blank" rel="noopener"
                        onclick="{{ $platform === 'copy' ? 'copyShareLink(event)' : '' }}"
                        class="{{ $sizeClass }} rounded-lg {{ $s['color'] }} text-white flex items-center justify-center hover:opacity-90 transition"
                        title="{{ $s['label'] }}"
                        @if($platform === 'copy') data-url="{{ $shareUrl }}" @endif>
                        {{ $s['icon'] }}
                    </a>
                @endif
            @endforeach
        </div>
    </div>
@elseif($variant === 'minimal')
    <div class="flex items-center gap-1">
        @foreach($platforms as $platform)
            @if(isset($socialLinks[$platform]))
                @php $s = $socialLinks[$platform]; @endphp
                <a href="{{ $s['url'] }}"
                    target="_blank" rel="noopener"
                    onclick="{{ $platform === 'copy' ? 'copyShareLink(event)' : '' }}"
                    class="{{ $sizeClass }} rounded-lg {{ $s['color'] }} text-white flex items-center justify-center hover:opacity-90 transition"
                    title="{{ $s['label'] }}"
                    @if($platform === 'copy') data-url="{{ $shareUrl }}" @endif>
                    {{ $s['icon'] }}
                </a>
            @endif
        @endforeach
    </div>
@else
    {{-- Inline --}}
    <div class="flex items-center gap-2">
        <span class="text-sm font-medium text-gray-700 dark:text-gray-300 mr-1">{{ $label }}:</span>
        @foreach($platforms as $platform)
            @if(isset($socialLinks[$platform]))
                @php $s = $socialLinks[$platform]; @endphp
                <a href="{{ $s['url'] }}"
                    target="_blank" rel="noopener"
                    onclick="{{ $platform === 'copy' ? 'copyShareLink(event)' : '' }}"
                    class="{{ $sizeClass }} rounded-lg {{ $s['color'] }} text-white flex items-center justify-center hover:opacity-90 transition"
                    title="{{ $s['label'] }}"
                    @if($platform === 'copy') data-url="{{ $shareUrl }}" @endif>
                    {{ $s['icon'] }}
                </a>
            @endif
        @endforeach
    </div>
@endif

<script>
function copyShareLink(e) {
    e.preventDefault();
    var url = e.currentTarget.getAttribute('data-url');
    navigator.clipboard.writeText(url).then(function() {
        var btn = e.currentTarget;
        var original = btn.innerHTML;
        btn.innerHTML = '✅';
        setTimeout(function() { btn.innerHTML = original; }, 1500);
    });
}
</script>