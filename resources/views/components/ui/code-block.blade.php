{{-- Komponen Code Block dengan Syntax Highlighting --}}
@props([
    'code' => '',
    'language' => 'blade',
    'showLineNumbers' => false,
    'showCopy' => true,
    'filename' => null,
])

@php
    $highlighted = $code;

    // Blade/PHP keywords
    $bladeKeywords = ['props', 'php', 'endphp', 'if', 'elseif', 'else', 'endif', 'foreach', 'endforeach', 'for', 'endfor', 'while', 'endwhile', 'isset', 'endisset', 'empty', 'slot', 'section', 'endsection', 'yield', 'extends', 'include', 'csrf', 'method', 'vite', 'json', 'unless', 'endunless', 'hasSection', 'push', 'endpush', 'stack', 'prepend', 'endprepend', 'once', 'endonce', 'error', 'enderror', 'auth', 'endauth', 'guest', 'endguest', 'env', 'endenv', 'production', 'endproduction', 'switch', 'case', 'break', 'default', 'endswitch', 'can', 'elsecan', 'endcan', 'cannot', 'elsecannot', 'endcannot', 'dump', 'dd', 'lang', 'choice', 'inject', 'each', 'verbatim', 'endverbatim', 'component', 'endcomponent', 'slot', 'endslot'];

    // Highlight Blade directives
    foreach ($bladeKeywords as $kw) {
        $highlighted = preg_replace('/(@' . preg_quote($kw, '/') . ')\b/', '<span style="color:#c678dd">$1</span>', $highlighted);
    }

    // Highlight HTML tags
    $highlighted = preg_replace('/(&lt;\/?x-[\w.-]+)/', '<span style="color:#e06c75">$1</span>', $highlighted);
    $highlighted = preg_replace('/(\/?&gt;)/', '<span style="color:#e06c75">$1</span>', $highlighted);

    // Highlight strings
    $highlighted = preg_replace('/"([^"]*)"/', '<span style="color:#98c379">"$1"</span>', $highlighted);

    // Highlight attributes
    foreach ($attributes as $attr) {
        $highlighted = preg_replace('/\b(' . $attr . ')=/', '<span style="color:#d19a66">$1</span>=', $highlighted);
    }

    // Highlight numbers
    $highlighted = preg_replace('/\b(\d+)\b/', '<span style="color:#d19a66">$1</span>', $highlighted);

    // Highlight comments
    $highlighted = preg_replace('/(&lt;!--.*?--&gt;)/s', '<span style="color:#5c6370;font-style:italic">$1</span>', $highlighted);
    $highlighted = preg_replace('/({{--.*?--}})/s', '<span style="color:#5c6370;font-style:italic">$1</span>', $highlighted);

    $lineCount = substr_count($code, "\n") + 1;
@endphp

<div class="rounded-xl overflow-hidden border border-gray-200 dark:border-gray-700 bg-[#282c34] shadow-lg">
    {{-- Header --}}
    @if($filename || $showCopy)
        <div class="flex items-center justify-between px-4 py-2.5 bg-[#21252b] border-b border-gray-700/50">
            <div class="flex items-center gap-3">
                <div class="flex gap-1.5">
                    <span class="w-3 h-3 rounded-full bg-red-500"></span>
                    <span class="w-3 h-3 rounded-full bg-yellow-500"></span>
                    <span class="w-3 h-3 rounded-full bg-green-500"></span>
                </div>
                @if($filename)
                    <span class="text-xs text-gray-400 font-mono">{{ $filename }}</span>
                @endif
            </div>
            @if($showCopy)
                <button onclick="copyCodeBlock(this)" class="flex items-center gap-1.5 px-2.5 py-1 text-xs text-gray-400 hover:text-white bg-gray-700/50 hover:bg-gray-700 rounded transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                    Copy
                </button>
            @endif
        </div>
    @endif

    {{-- Code --}}
    <div class="overflow-x-auto">
        <pre class="p-5 text-sm leading-relaxed font-mono text-[#abb2bf] {{ $showLineNumbers ? 'pl-0' : '' }}" style="tab-size: 4"><code>{!! $highlighted !!}</code></pre>
    </div>
</div>

<script>
function copyCodeBlock(btn) {
    const block = btn.closest('.rounded-xl');
    const code = block.querySelector('code').textContent;
    navigator.clipboard.writeText(code).then(() => {
        const original = btn.innerHTML;
        btn.innerHTML = '✅ Copied!';
        btn.classList.add('text-green-400');
        setTimeout(() => {
            btn.innerHTML = original;
            btn.classList.remove('text-green-400');
        }, 1500);
    });
}
</script>