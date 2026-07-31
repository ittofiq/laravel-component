@extends('layouts.app')
@section('title', 'Overlay - BacaDev')
@section('content')
<div class="flex min-h-screen">
    @include('pages.components.sidebar', ['currentCategory' => 'overlay'])
    <div class="flex-1 min-w-0 px-4 py-8">
        <h1 class="text-3xl font-bold mb-2 text-gray-900 dark:text-white">🪟 Overlay</h1>
        <p class="text-gray-600 dark:text-gray-400 mb-8">8 komponen: Modal, Drawer, Tooltip, Popover, Confirm Dialog, Bottom Sheet, Lightbox, Video Modal</p>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">

            {{-- Modal --}}
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow">
                <h3 class="font-bold mb-4 text-gray-900 dark:text-white">Modal</h3>
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-3">Focus trap, ESC close, scroll lock, 4 ukuran</p>
                <div class="flex flex-wrap gap-2">
                    <button onclick="openModal('modalSm')" class="px-4 py-2 text-sm bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">Small</button>
                    <button onclick="openModal('modalMd')" class="px-4 py-2 text-sm bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">Medium</button>
                    <button onclick="openModal('modalLg')" class="px-4 py-2 text-sm bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">Large</button>
                    <button onclick="openModal('modalXl')" class="px-4 py-2 text-sm bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">Extra Large</button>
                    <button onclick="openModal('modalFull')" class="px-4 py-2 text-sm bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">Full</button>
                </div>

                <x-overlay.modal id="modalSm" title="Small Modal" size="sm">
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Small modal — cocok untuk konfirmasi singkat atau alert dialog.</p>
                    <div class="flex justify-end gap-2 mt-4">
                        <x-ui.button variant="secondary" size="sm" onclick="closeModal('modalSm')">Cancel</x-ui.button>
                        <x-ui.button variant="primary" size="sm">OK</x-ui.button>
                    </div>
                </x-overlay.modal>

                <x-overlay.modal id="modalMd" title="Medium Modal" size="md">
                    <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">Medium modal (default) — ukuran paling umum untuk form dan konten.</p>
                    <div class="space-y-3">
                        <x-form.input name="name" label="Name" placeholder="Enter name..." />
                        <x-form.input name="email" label="Email" type="email" placeholder="Enter email..." />
                    </div>
                    <div class="flex justify-end gap-2 mt-4">
                        <x-ui.button variant="secondary" size="sm" onclick="closeModal('modalMd')">Cancel</x-ui.button>
                        <x-ui.button variant="primary" size="sm">Save</x-ui.button>
                    </div>
                </x-overlay.modal>

                <x-overlay.modal id="modalLg" title="Large Modal" size="lg">
                    <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">Large modal — cocok untuk form panjang, tabel, atau detail konten.</p>
                    <div class="grid grid-cols-2 gap-3">
                        <x-form.input name="first_name" label="First Name" />
                        <x-form.input name="last_name" label="Last Name" />
                        <x-form.input name="email2" label="Email" type="email" />
                        <x-form.input name="phone" label="Phone" />
                    </div>
                    <x-form.textarea name="notes" label="Notes" rows="3" class="mt-3" />
                    <div class="flex justify-end gap-2 mt-4">
                        <x-ui.button variant="secondary" size="sm" onclick="closeModal('modalLg')">Cancel</x-ui.button>
                        <x-ui.button variant="primary" size="sm">Submit</x-ui.button>
                    </div>
                </x-overlay.modal>

                <x-overlay.modal id="modalXl" title="Extra Large Modal" size="xl">
                    <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">XL modal — untuk konten kompleks seperti tabel atau multi-section form.</p>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="bg-gray-50 dark:bg-gray-700/50 border-b"><tr><th class="px-4 py-2 text-left">#</th><th class="px-4 py-2 text-left">Item</th><th class="px-4 py-2 text-left">Qty</th><th class="px-4 py-2 text-right">Price</th></tr></thead>
                            <tbody>
                                <tr class="border-b dark:border-gray-700"><td class="px-4 py-2">1</td><td class="px-4 py-2">Product A</td><td class="px-4 py-2">2</td><td class="px-4 py-2 text-right">$25.00</td></tr>
                                <tr class="border-b dark:border-gray-700"><td class="px-4 py-2">2</td><td class="px-4 py-2">Product B</td><td class="px-4 py-2">1</td><td class="px-4 py-2 text-right">$50.00</td></tr>
                                <tr class="border-b dark:border-gray-700"><td class="px-4 py-2">3</td><td class="px-4 py-2">Product C</td><td class="px-4 py-2">5</td><td class="px-4 py-2 text-right">$10.00</td></tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="flex justify-end gap-2 mt-4">
                        <x-ui.button variant="secondary" size="sm" onclick="closeModal('modalXl')">Close</x-ui.button>
                    </div>
                </x-overlay.modal>

                <x-overlay.modal id="modalFull" title="Full Width Modal" size="full">
                    <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">Full width modal — hampir memenuhi layar untuk konten besar seperti dashboard embed atau preview dokumen.</p>
                    <div class="grid grid-cols-3 gap-4">
                        <div class="col-span-2 bg-gray-50 dark:bg-gray-700/50 rounded-lg p-6 flex items-center justify-center text-gray-400 dark:text-gray-500 text-sm">Main Content Area</div>
                        <div class="bg-gray-50 dark:bg-gray-700/50 rounded-lg p-6 flex items-center justify-center text-gray-400 dark:text-gray-500 text-sm">Sidebar</div>
                    </div>
                    <div class="flex justify-end gap-2 mt-4">
                        <x-ui.button variant="secondary" size="sm" onclick="closeModal('modalFull')">Close</x-ui.button>
                    </div>
                </x-overlay.modal>
            </div>

            {{-- Drawer --}}
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow">
                <h3 class="font-bold mb-4 text-gray-900 dark:text-white">Drawer</h3>
                <button onclick="openDrawer_demoDrawer()" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">Open Drawer</button>
                <div class="flex flex-wrap gap-2">
                        <button onclick="openDrawer_demoDrawer()" class="px-4 py-2 text-sm bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">Right</button>
                        <button onclick="openDrawer_demoDrawerLeft()" class="px-4 py-2 text-sm bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">Left</button>
                    </div>
                    <x-overlay.drawer id="demoDrawer" title="Right Drawer" position="right">
                        <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">Drawer dari kanan — cocok untuk panel filter, detail, atau sidebar.</p>
                        <div class="space-y-3">
                            <x-form.input name="search" placeholder="Search..." />
                            <x-form.checkbox name="opt1" label="Option 1" />
                            <x-form.checkbox name="opt2" label="Option 2" />
                            <x-form.checkbox name="opt3" label="Option 3" />
                        </div>
                        <div class="flex gap-2 mt-4">
                            <x-ui.button variant="primary" size="sm">Apply</x-ui.button>
                            <x-ui.button variant="secondary" size="sm" onclick="closeDrawer_demoDrawer()">Close</x-ui.button>
                        </div>
                    </x-overlay.drawer>
                    <x-overlay.drawer id="demoDrawerLeft" title="Left Drawer" position="left">
                        <p class="text-gray-600 dark:text-gray-400 text-sm">Drawer dari kiri — cocok untuk navigasi mobile atau menu.</p>
                        <div class="space-y-1 mt-3">
                            <a href="#" class="block px-3 py-2 rounded-lg text-sm hover:bg-gray-100 dark:hover:bg-gray-700">📊 Dashboard</a>
                            <a href="#" class="block px-3 py-2 rounded-lg text-sm hover:bg-gray-100 dark:hover:bg-gray-700">👥 Users</a>
                            <a href="#" class="block px-3 py-2 rounded-lg text-sm hover:bg-gray-100 dark:hover:bg-gray-700">📦 Products</a>
                            <a href="#" class="block px-3 py-2 rounded-lg text-sm hover:bg-gray-100 dark:hover:bg-gray-700">⚙️ Settings</a>
                        </div>
                    </x-overlay.drawer>
            </div>

            {{-- Tooltip --}}
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow">
                <h3 class="font-bold mb-4 text-gray-900 dark:text-white">Tooltip</h3>
                <div class="flex flex-wrap gap-4 items-center">
                    <x-overlay.tooltip text="Tooltip on top" position="top">
                        <span class="px-3 py-1.5 bg-gray-100 dark:bg-gray-700 rounded-lg text-sm cursor-help">Top ↑</span>
                    </x-overlay.tooltip>
                    <x-overlay.tooltip text="Tooltip on bottom" position="bottom">
                        <span class="px-3 py-1.5 bg-gray-100 dark:bg-gray-700 rounded-lg text-sm cursor-help">Bottom ↓</span>
                    </x-overlay.tooltip>
                    <x-overlay.tooltip text="Tooltip on left" position="left">
                        <span class="px-3 py-1.5 bg-gray-100 dark:bg-gray-700 rounded-lg text-sm cursor-help">Left ←</span>
                    </x-overlay.tooltip>
                    <x-overlay.tooltip text="Tooltip on right" position="right">
                        <span class="px-3 py-1.5 bg-gray-100 dark:bg-gray-700 rounded-lg text-sm cursor-help">Right →</span>
                    </x-overlay.tooltip>
                    <x-overlay.tooltip text="Delayed 500ms" :delay="500">
                        <span class="px-3 py-1.5 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 rounded-lg text-sm cursor-help">Delay 500ms</span>
                    </x-overlay.tooltip>
                </div>
            </div>

            {{-- Popover --}}
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow">
                <h3 class="font-bold mb-4 text-gray-900 dark:text-white">Popover</h3>
                <div class="flex flex-wrap gap-3">
                    <x-overlay.popover title="Information" text="This is a popover with title and description.">
                        <span class="px-3 py-1.5 bg-gray-100 dark:bg-gray-700 rounded-lg text-sm cursor-pointer">Click me</span>
                    </x-overlay.popover>
                    <x-overlay.popover title="Help" text="Need assistance? Contact our support team at support@example.com">
                        <span class="px-3 py-1.5 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 rounded-lg text-sm cursor-pointer">Help</span>
                    </x-overlay.popover>
                </div>
            </div>

            {{-- Confirm Dialog --}}
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow">
                <h3 class="font-bold mb-4 text-gray-900 dark:text-white">Confirm Dialog</h3>
                <div class="flex flex-wrap gap-2">
                        <button onclick="openConfirm_confirm()" class="px-4 py-2 text-sm bg-red-500 text-white rounded-lg hover:bg-red-600 transition">Delete</button>
                        <button onclick="openConfirm_confirmArchive()" class="px-4 py-2 text-sm bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition">Archive</button>
                        <button onclick="openConfirm_confirmPublish()" class="px-4 py-2 text-sm bg-green-500 text-white rounded-lg hover:bg-green-600 transition">Publish</button>
                    </div>
                    <x-overlay.confirm-dialog id="confirm" title="Delete Item?" message="Item yang dihapus tidak dapat dikembalikan." confirmText="Delete" cancelText="Cancel" />
                    <x-overlay.confirm-dialog id="confirmArchive" title="Archive Item?" message="Item akan dipindahkan ke arsip." confirmText="Archive" cancelText="Cancel" />
                    <x-overlay.confirm-dialog id="confirmPublish" title="Publish Now?" message="Konten akan dipublikasikan ke semua pengguna." confirmText="Publish" cancelText="Cancel" />
            </div>

            {{-- Bottom Sheet --}}
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow">
                <h3 class="font-bold mb-4 text-gray-900 dark:text-white">Bottom Sheet</h3>
                <div x-data>
                    <button onclick="openSheet_sheet()" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">Open Sheet</button>
                <x-overlay.bottom-sheet id="sheet" title="Share Options">
                        <div class="space-y-2">
                            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition text-sm">
                                <span class="text-xl">📋</span> <span>Copy Link</span>
                            </a>
                            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition text-sm">
                                <span class="text-xl">🐦</span> <span>Share to Twitter</span>
                            </a>
                            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition text-sm">
                                <span class="text-xl">📧</span> <span>Share via Email</span>
                            </a>
                            <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition text-sm">
                                <span class="text-xl">💬</span> <span>Share to WhatsApp</span>
                            </a>
                            <button onclick="closeSheet_sheet()" class="w-full px-4 py-3 text-sm font-medium text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition mt-2">Cancel</button>
                        </div>
                    </x-overlay.bottom-sheet>
            </div>

            {{-- Image Lightbox --}}
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow">
                <h3 class="font-bold mb-4 text-gray-900 dark:text-white">Image Lightbox</h3>
                <x-overlay.image-lightbox :images="[
                    'data:image/svg+xml,'.rawurlencode('<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'400\' height=\'300\'><rect fill=\'#3B82F6\' width=\'400\' height=\'300\'/><text x=\'50%\' y=\'50%\' text-anchor=\'middle\' dy=\'.3em\' fill=\'white\' font-size=\'20\'>Image 1</text></svg>'),
                    'data:image/svg+xml,'.rawurlencode('<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'400\' height=\'300\'><rect fill=\'#10B981\' width=\'400\' height=\'300\'/><text x=\'50%\' y=\'50%\' text-anchor=\'middle\' dy=\'.3em\' fill=\'white\' font-size=\'20\'>Image 2</text></svg>'),
                    'data:image/svg+xml,'.rawurlencode('<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'400\' height=\'300\'><rect fill=\'#F59E0B\' width=\'400\' height=\'300\'/><text x=\'50%\' y=\'50%\' text-anchor=\'middle\' dy=\'.3em\' fill=\'white\' font-size=\'20\'>Image 3</text></svg>')
                ]" />
            </div>

            {{-- Video Modal --}}
            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow">
                <h3 class="font-bold mb-4 text-gray-900 dark:text-white">Video Modal</h3>
                <x-overlay.video-modal videoId="dQw4w9WgXcQ" title="Watch Video" />
            </div>
        </div>
    </div>
</div>
@endsection