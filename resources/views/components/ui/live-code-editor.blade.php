{{-- Komponen Live Code Editor - Edit props/code & lihat hasil real-time --}}
@props([
    'label' => 'Live Code Editor',
    'defaultCode' => '',
    'height' => '320px',
])

<div
    x-data="{
        code: @js($defaultCode),
        originalCode: @js($defaultCode),
        get lines() { return this.code.split('\n').length; },
        get lineNumbers() {
            let nums = '';
            for (let i = 1; i <= this.lines; i++) nums += i + '\n';
            return nums;
        },
        reset() { this.code = this.originalCode; },
        copy() {
            navigator.clipboard.writeText(this.code).then(() => {
                this.$refs.copyBtn.innerHTML = '✅ Copied!';
                this.$refs.copyBtn.classList.add('text-green-400');
                setTimeout(() => {
                    this.$refs.copyBtn.innerHTML = `<svg class='w-3.5 h-3.5' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z'/></svg> Copy`;
                    this.$refs.copyBtn.classList.remove('text-green-400');
                }, 1500);
            });
        }
    }"
    class="rounded-xl overflow-hidden border border-gray-200 dark:border-gray-700 shadow-lg"
>
    {{-- Header --}}
    <div class="flex items-center justify-between px-4 py-2.5 bg-[#21252b] border-b border-gray-700/50">
        <div class="flex items-center gap-3">
            <div class="flex gap-1.5">
                <span class="w-3 h-3 rounded-full bg-red-500"></span>
                <span class="w-3 h-3 rounded-full bg-yellow-500"></span>
                <span class="w-3 h-3 rounded-full bg-green-500"></span>
            </div>
            <span class="text-xs text-gray-400 font-medium">{{ $label }}</span>
        </div>
        <div class="flex items-center gap-2">
            <button @click="reset()" class="flex items-center gap-1 px-2 py-1 text-xs text-gray-400 hover:text-white bg-gray-700/50 hover:bg-gray-700 rounded transition-colors" title="Reset to default">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                Reset
            </button>
            <button @click="copy()" x-ref="copyBtn" class="flex items-center gap-1 px-2 py-1 text-xs text-gray-400 hover:text-white bg-gray-700/50 hover:bg-gray-700 rounded transition-colors" title="Copy code">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                Copy
            </button>
        </div>
    </div>

    {{-- Editor + Preview Split --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 divide-y lg:divide-y-0 lg:divide-x divide-gray-200 dark:divide-gray-700">
        {{-- Code Editor --}}
        <div class="flex bg-[#282c34]" style="min-height: {{ $height }}">
            {{-- Line Numbers --}}
            <div class="flex-shrink-0 py-4 pl-4 pr-2 text-right select-none">
                <pre class="text-sm leading-relaxed font-mono text-gray-500" x-text="lineNumbers" style="tab-size: 4; line-height: 1.625"></pre>
            </div>
            {{-- Textarea --}}
            <div class="flex-1 py-4 pr-4">
                <textarea
                    x-model="code"
                    class="w-full h-full bg-transparent text-sm leading-relaxed font-mono text-[#abb2bf] resize-none outline-none border-none placeholder-gray-600"
                    style="tab-size: 4; line-height: 1.625; min-height: {{ $height }}"
                    placeholder="Type HTML code here..."
                    spellcheck="false"
                ></textarea>
            </div>
        </div>

        {{-- Live Preview --}}
        <div class="bg-white dark:bg-gray-900">
            <div class="px-3 py-2 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50">
                <span class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider flex items-center gap-1.5">
                    <span class="w-1.5 h-1.5 rounded-full bg-green-400 animate-pulse"></span>
                    Live Preview
                </span>
            </div>
            <div class="p-6 flex items-center justify-center" style="min-height: {{ $height }}">
                <div x-html="code" class="w-full"></div>
            </div>
        </div>
    </div>
</div>