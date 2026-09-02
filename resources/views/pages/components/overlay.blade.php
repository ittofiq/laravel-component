@extends('layouts.app')
@section('title', 'Overlay - BacaDev')
@section('content')
<div class="flex min-h-screen">
    @include('pages.components.sidebar', ['currentCategory' => 'overlay'])
    <div class="flex-1 min-w-0 px-4 py-8">
        <h1 class="text-3xl font-bold mb-2 text-gray-900 dark:text-white">🪟 Overlay</h1>
        <p class="text-gray-600 dark:text-gray-400 mb-8">8 komponen: Modal, Drawer, Tooltip, Popover, Confirm Dialog, Bottom Sheet, Lightbox, Video Modal</p>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6">

            <x-ui.demo-card title="Modal" component="overlay.modal" :props="[
                ['name' => 'id', 'type' => 'string', 'default' => '\'modal\'', 'description' => 'Identifier unik'],
                ['name' => 'title', 'type' => 'string|null', 'default' => 'null', 'description' => 'Judul modal'],
                ['name' => 'size', 'type' => 'string', 'default' => '\'md\'', 'description' => 'sm, md, lg, xl, full'],
                ['name' => 'closeable', 'type' => 'bool', 'default' => 'true', 'description' => 'Tombol X'],
                ['name' => 'closeOnOutside', 'type' => 'bool', 'default' => 'true', 'description' => 'Tutup saat klik backdrop'],
                ['name' => 'closeOnEsc', 'type' => 'bool', 'default' => 'true', 'description' => 'Tutup saat ESC'],
                ['name' => 'scrollLock', 'type' => 'bool', 'default' => 'true', 'description' => 'Kunci scroll body'],
            ]">
                <p class="text-xs text-gray-500 dark:text-gray-400 mb-3">Focus trap, ESC close, scroll lock, 4 ukuran</p>
                <div class="flex flex-wrap gap-2">
                    <button onclick="openModal('modalSm')" class="px-3 py-1.5 text-sm bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">Small</button>
                    <button onclick="openModal('modalMd')" class="px-3 py-1.5 text-sm bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">Medium</button>
                    <button onclick="openModal('modalLg')" class="px-3 py-1.5 text-sm bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">Large</button>
                    <button onclick="openModal('modalFull')" class="px-3 py-1.5 text-sm bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">Full</button>
                </div>

                <x-overlay.modal id="modalSm" title="Small Modal" size="sm">
                    <p class="text-gray-600 dark:text-gray-400 text-sm">Small modal — cocok untuk konfirmasi singkat.</p>
                    <div class="flex justify-end gap-2 mt-4">
                        <x-ui.button variant="secondary" size="sm" onclick="closeModal('modalSm')">Cancel</x-ui.button>
                        <x-ui.button variant="primary" size="sm">OK</x-ui.button>
                    </div>
                </x-overlay.modal>

                <x-overlay.modal id="modalMd" title="Medium Modal" size="md">
                    <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">Medium modal (default) — ukuran paling umum.</p>
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
                    <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">Large modal — untuk form panjang atau detail konten.</p>
                    <div class="grid grid-cols-2 gap-3">
                        <x-form.input name="first_name" label="First Name" />
                        <x-form.input name="last_name" label="Last Name" />
                        <x-form.input name="email2" label="Email" type="email" />
                        <x-form.input name="phone" label="Phone" />
                    </div>
                    <div class="flex justify-end gap-2 mt-4">
                        <x-ui.button variant="secondary" size="sm" onclick="closeModal('modalLg')">Cancel</x-ui.button>
                        <x-ui.button variant="primary" size="sm">Submit</x-ui.button>
                    </div>
                </x-overlay.modal>

                <x-overlay.modal id="modalFull" title="Full Width Modal" size="full">
                    <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">Full width modal — hampir memenuhi layar.</p>
                    <div class="flex justify-end gap-2 mt-4">
                        <x-ui.button variant="secondary" size="sm" onclick="closeModal('modalFull')">Close</x-ui.button>
                    </div>
                </x-overlay.modal>
            </x-ui.demo-card>

            <x-ui.demo-card title="Drawer" component="overlay.drawer" :props="[
                ['name' => 'id', 'type' => 'string', 'default' => '\'drawer\'', 'description' => 'Identifier unik'],
                ['name' => 'title', 'type' => 'string|null', 'default' => 'null', 'description' => 'Judul drawer'],
                ['name' => 'position', 'type' => 'string', 'default' => '\'left\'', 'description' => 'left, right'],
            ]">
                <button onclick="openDrawer_demoDrawer()" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">Open Drawer</button>
                <x-overlay.drawer id="demoDrawer" title="Right Drawer" position="right">
                    <p class="text-gray-600 dark:text-gray-400 text-sm mb-4">Drawer dari kanan — untuk panel filter, detail, atau sidebar.</p>
                    <div class="space-y-3">
                        <x-form.input name="search" placeholder="Search..." />
                        <x-form.checkbox name="opt1" label="Option 1" />
                        <x-form.checkbox name="opt2" label="Option 2" />
                    </div>
                    <div class="flex gap-2 mt-4">
                        <x-ui.button variant="primary" size="sm">Apply</x-ui.button>
                        <x-ui.button variant="secondary" size="sm" onclick="closeDrawer_demoDrawer()">Close</x-ui.button>
                    </div>
                </x-overlay.drawer>
            </x-ui.demo-card>

            <x-ui.demo-card title="Tooltip" component="overlay.tooltip" :props="[
                ['name' => 'text', 'type' => 'string', 'default' => '\'\'', 'description' => 'Teks tooltip'],
                ['name' => 'position', 'type' => 'string', 'default' => '\'top\'', 'description' => 'top, bottom, left, right'],
                ['name' => 'delay', 'type' => 'int', 'default' => '300', 'description' => 'Delay tampil (ms)'],
                ['name' => 'arrow', 'type' => 'bool', 'default' => 'true', 'description' => 'Tampilkan panah'],
            ]">
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
                </div>
            </x-ui.demo-card>

            <x-ui.demo-card title="Popover" component="overlay.popover" :props="[
                ['name' => 'title', 'type' => 'string|null', 'default' => 'null', 'description' => 'Judul popover'],
                ['name' => 'text', 'type' => 'string', 'default' => '\'\'', 'description' => 'Isi popover'],
                ['name' => 'position', 'type' => 'string', 'default' => '\'top\'', 'description' => 'top, bottom, left, right'],
            ]">
                <div class="flex flex-wrap gap-3">
                    <x-overlay.popover title="Information" text="This is a popover with title and description.">
                        <span class="px-3 py-1.5 bg-gray-100 dark:bg-gray-700 rounded-lg text-sm cursor-pointer">Click me</span>
                    </x-overlay.popover>
                    <x-overlay.popover title="Help" text="Need assistance? Contact our support team.">
                        <span class="px-3 py-1.5 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 rounded-lg text-sm cursor-pointer">Help</span>
                    </x-overlay.popover>
                </div>
            </x-ui.demo-card>

            <x-ui.demo-card title="Confirm Dialog" component="overlay.confirm-dialog" :props="[
                ['name' => 'id', 'type' => 'string', 'default' => '\'confirmDialog\'', 'description' => 'Identifier unik'],
                ['name' => 'title', 'type' => 'string', 'default' => '\'Konfirmasi\'', 'description' => 'Judul dialog'],
                ['name' => 'message', 'type' => 'string', 'default' => '—', 'description' => 'Pesan konfirmasi'],
                ['name' => 'confirmText', 'type' => 'string', 'default' => '\'Ya, Lanjutkan\'', 'description' => 'Teks tombol konfirmasi'],
                ['name' => 'cancelText', 'type' => 'string', 'default' => '\'Batal\'', 'description' => 'Teks tombol batal'],
            ]">
                <div class="flex flex-wrap gap-2">
                    <button onclick="openConfirm_confirm()" class="px-4 py-2 text-sm bg-red-500 text-white rounded-lg hover:bg-red-600 transition">Delete</button>
                    <button onclick="openConfirm_confirmArchive()" class="px-4 py-2 text-sm bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 transition">Archive</button>
                    <button onclick="openConfirm_confirmPublish()" class="px-4 py-2 text-sm bg-green-500 text-white rounded-lg hover:bg-green-600 transition">Publish</button>
                </div>
                <x-overlay.confirm-dialog id="confirm" title="Delete Item?" message="Item yang dihapus tidak dapat dikembalikan." confirmText="Delete" cancelText="Cancel" />
                <x-overlay.confirm-dialog id="confirmArchive" title="Archive Item?" message="Item akan dipindahkan ke arsip." confirmText="Archive" cancelText="Cancel" />
                <x-overlay.confirm-dialog id="confirmPublish" title="Publish Now?" message="Konten akan dipublikasikan ke semua pengguna." confirmText="Publish" cancelText="Cancel" />
            </x-ui.demo-card>

            <x-ui.demo-card title="Bottom Sheet" component="overlay.bottom-sheet" :props="[
                ['name' => 'id', 'type' => 'string', 'default' => '\'bottomSheet\'', 'description' => 'Identifier unik'],
                ['name' => 'title', 'type' => 'string|null', 'default' => 'null', 'description' => 'Judul sheet'],
            ]">
                <button onclick="openSheet_sheet()" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">Open Sheet</button>
                <x-overlay.bottom-sheet id="sheet" title="Share Options">
                    <div class="space-y-2">
                        <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition text-sm text-gray-700 dark:text-gray-300">
                            <span class="text-xl">📋</span> <span>Copy Link</span>
                        </a>
                        <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition text-sm text-gray-700 dark:text-gray-300">
                            <span class="text-xl">🐦</span> <span>Share to Twitter</span>
                        </a>
                        <button onclick="closeSheet_sheet()" class="w-full px-4 py-3 text-sm font-medium text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition mt-2">Cancel</button>
                    </div>
                </x-overlay.bottom-sheet>
            </x-ui.demo-card>

            <x-ui.demo-card title="Image Lightbox" component="overlay.image-lightbox" :props="[
                ['name' => 'images', 'type' => 'array', 'default' => '[]', 'description' => 'Daftar URL gambar'],
            ]">
                <x-overlay.image-lightbox :images="[
                    'data:image/svg+xml,'.rawurlencode('<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'400\' height=\'300\'><rect fill=\'#3B82F6\' width=\'400\' height=\'300\'/><text x=\'50%\' y=\'50%\' text-anchor=\'middle\' dy=\'.3em\' fill=\'white\' font-size=\'20\'>Image 1</text></svg>'),
                    'data:image/svg+xml,'.rawurlencode('<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'400\' height=\'300\'><rect fill=\'#10B981\' width=\'400\' height=\'300\'/><text x=\'50%\' y=\'50%\' text-anchor=\'middle\' dy=\'.3em\' fill=\'white\' font-size=\'20\'>Image 2</text></svg>'),
                    'data:image/svg+xml,'.rawurlencode('<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'400\' height=\'300\'><rect fill=\'#F59E0B\' width=\'400\' height=\'300\'/><text x=\'50%\' y=\'50%\' text-anchor=\'middle\' dy=\'.3em\' fill=\'white\' font-size=\'20\'>Image 3</text></svg>')
                ]" />
            </x-ui.demo-card>

            <x-ui.demo-card title="Video Modal" component="overlay.video-modal" :props="[
                ['name' => 'videoId', 'type' => 'string|null', 'default' => 'null', 'description' => 'ID video YouTube'],
                ['name' => 'title', 'type' => 'string', 'default' => '\'Watch Video\'', 'description' => 'Teks tombol'],
            ]">
                <x-overlay.video-modal videoId="dQw4w9WgXcQ" title="Watch Video" />
            </x-ui.demo-card>

        </div>
    </div>
</div>
@endsection