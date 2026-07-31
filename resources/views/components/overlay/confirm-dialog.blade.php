{{-- Komponen Confirm Dialog dengan Alpine.js --}}
@props([
    'title' => 'Konfirmasi',
    'message' => 'Apakah Anda yakin?',
    'confirmText' => 'Ya, Lanjutkan',
    'cancelText' => 'Batal',
    'id' => 'confirmDialog',
])

<div x-data="confirmDialog('{{ $id }}')" @keydown.escape="open = false">
    {{-- Overlay --}}
    <div
        x-show="open"
        x-transition:enter="transition-opacity duration-200"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center"
        style="display: none;"
    >
        <div
            @click.outside="open = false"
            role="alertdialog"
            aria-modal="true"
            aria-labelledby="confirm-title-{{ $id }}"
            aria-describedby="confirm-message-{{ $id }}"
            class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl max-w-sm w-full mx-4 p-6 space-y-4"
            x-transition:enter="transition-all duration-200"
            x-transition:enter-start="scale-95 opacity-0"
            x-transition:enter-end="scale-100 opacity-100"
        >
            <div class="text-center">
                <div class="w-12 h-12 rounded-full bg-red-100 dark:bg-red-900/30 mx-auto mb-3 flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                </div>
                <h2 id="confirm-title-{{ $id }}" class="text-lg font-bold text-gray-900 dark:text-white">{{ $title }}</h2>
                <p id="confirm-message-{{ $id }}" class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $message }}</p>
            </div>
            <div class="flex gap-3">
                <button @click="open = false" class="flex-1 px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition font-medium">
                    {{ $cancelText }}
                </button>
                <button @click="open = false" class="flex-1 px-4 py-2.5 rounded-lg bg-red-500 text-white hover:bg-red-600 transition font-medium">
                    {{ $confirmText }}
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDialog(dialogId) {
    return {
        open: false,
        init() {
            window['openConfirm_' + dialogId] = () => this.open = true;
            window['closeConfirm_' + dialogId] = () => this.open = false;
        }
    };
}
</script>