{{-- Komponen Rich Text Editor --}}
@props([
    'name' => null,
    'label' => null,
    'value' => null,
    'rows' => 10,
    'placeholder' => 'Ketik di sini...',
])

@php
    $editorId = 'editor-' . uniqid();
@endphp

<div class="flex flex-col gap-2">
    @if($label)
        <label class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $label }}</label>
    @endif

    <div class="border border-gray-300 dark:border-gray-600 rounded-lg overflow-hidden bg-white dark:bg-gray-800">
        {{-- Toolbar --}}
        <div class="flex flex-wrap items-center gap-0.5 px-2 py-2 bg-gray-50 dark:bg-gray-700 border-b border-gray-200 dark:border-gray-600">
            <button type="button" onclick="formatDoc('bold', '{{ $editorId }}')" title="Bold"
                class="p-1.5 rounded hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                <svg class="w-4 h-4 text-gray-700 dark:text-gray-300" fill="currentColor" viewBox="0 0 24 24"><path d="M15.6 10.79c.97-.67 1.65-1.77 1.65-2.79 0-2.26-1.75-4-4-4H7v14h7.04c2.09 0 3.71-1.7 3.71-3.79 0-1.52-.86-2.82-2.15-3.42zM10 6.5h3c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5h-3v-3zm3.5 9H10v-3h3.5c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5z"/></svg>
            </button>
            <button type="button" onclick="formatDoc('italic', '{{ $editorId }}')" title="Italic"
                class="p-1.5 rounded hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                <svg class="w-4 h-4 text-gray-700 dark:text-gray-300" fill="currentColor" viewBox="0 0 24 24"><path d="M10 4v3h2.21l-3.42 8H6v3h8v-3h-2.21l3.42-8H18V4z"/></svg>
            </button>
            <button type="button" onclick="formatDoc('underline', '{{ $editorId }}')" title="Underline"
                class="p-1.5 rounded hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                <svg class="w-4 h-4 text-gray-700 dark:text-gray-300" fill="currentColor" viewBox="0 0 24 24"><path d="M12 17c3.31 0 6-2.69 6-6V3h-2.5v8c0 1.93-1.57 3.5-3.5 3.5S8.5 12.93 8.5 11V3H6v8c0 3.31 2.69 6 6 6zm-7 2v2h14v-2H5z"/></svg>
            </button>

            <div class="w-px h-5 bg-gray-300 dark:bg-gray-500 mx-1"></div>

            <button type="button" onclick="formatDoc('insertOrderedList', '{{ $editorId }}')" title="Ordered List"
                class="p-1.5 rounded hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                <svg class="w-4 h-4 text-gray-700 dark:text-gray-300" fill="currentColor" viewBox="0 0 24 24"><path d="M2 17h2v.5H3v1h1v.5H2v1h3v-4H2v1zm1-9h1V4H2v1h1v3zm-1 3h1.8L2 13.1v.9h3v-1H3.2L5 10.9V10H2v1zm5-6v2h14V5H7zm0 14h14v-2H7v2zm0-6h14v-2H7v2z"/></svg>
            </button>
            <button type="button" onclick="formatDoc('insertUnorderedList', '{{ $editorId }}')" title="Unordered List"
                class="p-1.5 rounded hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                <svg class="w-4 h-4 text-gray-700 dark:text-gray-300" fill="currentColor" viewBox="0 0 24 24"><path d="M4 10.5c-.83 0-1.5.67-1.5 1.5s.67 1.5 1.5 1.5 1.5-.67 1.5-1.5-.67-1.5-1.5-1.5zm0-6c-.83 0-1.5.67-1.5 1.5S3.17 7.5 4 7.5 5.5 6.83 5.5 6 4.83 4.5 4 4.5zm0 12c-.83 0-1.5.68-1.5 1.5s.68 1.5 1.5 1.5 1.5-.68 1.5-1.5-.67-1.5-1.5-1.5zM7 19h14v-2H7v2zm0-6h14v-2H7v2zm0-8v2h14V5H7z"/></svg>
            </button>

            <div class="w-px h-5 bg-gray-300 dark:bg-gray-500 mx-1"></div>

            <button type="button" onclick="insertLink('{{ $editorId }}')" title="Insert Link"
                class="p-1.5 rounded hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                <svg class="w-4 h-4 text-gray-700 dark:text-gray-300" fill="currentColor" viewBox="0 0 24 24"><path d="M3.9 12c0-1.71 1.39-3.1 3.1-3.1h4V7H7c-2.76 0-5 2.24-5 5s2.24 5 5 5h4v-1.9H7c-1.71 0-3.1-1.39-3.1-3.1zM8 13h8v-2H8v2zm9-6h-4v1.9h4c1.71 0 3.1 1.39 3.1 3.1s-1.39 3.1-3.1 3.1h-4V17h4c2.76 0 5-2.24 5-5s-2.24-5-5-5z"/></svg>
            </button>
        </div>

        {{-- Editor --}}
        <div
            id="{{ $editorId }}"
            contenteditable="true"
            oninput="syncContent('{{ $editorId }}', '{{ $name }}')"
            class="w-full px-4 py-3 text-gray-900 dark:text-white bg-white dark:bg-gray-800 focus:outline-none"
            style="min-height: {{ $rows * 24 }}px"
            placeholder="{{ $placeholder }}"
        >{!! $value !!}</div>

        <input type="hidden" name="{{ $name }}" id="hidden-{{ $editorId }}">
    </div>
</div>

<script>
function formatDoc(command, editorId) {
    const editor = document.getElementById(editorId);
    editor.focus();
    document.execCommand(command, false, null);
    syncContent(editorId, null);
}

function insertLink(editorId) {
    const editor = document.getElementById(editorId);
    editor.focus();
    const url = prompt('Masukkan URL:', 'https://');
    if (url) {
        editor.focus();
        document.execCommand('createLink', false, url);
        syncContent(editorId, null);
    }
    editor.focus();
}

function syncContent(editorId, name) {
    const editor = document.getElementById(editorId);
    if (!editor) return;
    const hidden = document.getElementById('hidden-' + editorId);
    if (hidden) {
        hidden.value = editor.innerHTML;
    }
}
</script>