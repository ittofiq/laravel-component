@extends('layouts.app')

@section('title', 'NexaDev — Software House')

@section('content')
{{-- Navbar --}}
<x-navigation.navbar
    brand="NexaDev"
    :links="[
        ['label' => 'Beranda', 'href' => '/software-house', 'active' => true],
        ['label' => 'Layanan', 'href' => '#layanan'],
        ['label' => 'Portofolio', 'href' => '#portofolio'],
        ['label' => 'Harga', 'href' => '#harga'],
        ['label' => 'Kontak', 'href' => '#kontak'],
    ]"
    :fixed="false"
    variant="colored"
    :shadow="false"
/>

{{-- Hero --}}
<x-layout.hero
    title="Kami Bangun Produk Digital untuk Bisnis Anda"
    subtitle="Software house yang fokus pada web application, mobile, dan solusi custom — dari ide sampai production."
/>

{{-- Layanan --}}
<x-layout.section id="layanan" title="Layanan Kami" subtitle="Solusi end-to-end untuk kebutuhan digital Anda." :centered="true">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="p-6 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700">
            <div class="text-3xl mb-3">🌐</div>
            <h3 class="font-bold text-gray-900 dark:text-white">Web Development</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Website company profile, e-commerce, dan web app berbasis Laravel.</p>
        </div>
        <div class="p-6 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700">
            <div class="text-3xl mb-3">📱</div>
            <h3 class="font-bold text-gray-900 dark:text-white">Mobile Development</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Aplikasi mobile Android/iOS yang cepat, responsif, dan scalable.</p>
        </div>
        <div class="p-6 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700">
            <div class="text-3xl mb-3">🎨</div>
            <h3 class="font-bold text-gray-900 dark:text-white">UI/UX Design</h3>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Desain interface yang clean dan user-friendly untuk produk Anda.</p>
        </div>
    </div>
</x-layout.section>

{{-- Statistik --}}
<x-layout.section title="Angka Kami" :centered="true">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <x-data.stat-card label="Proyek Selesai" value="250+" icon="🚀" trend="+12%" :trendUp="true" />
        <x-data.stat-card label="Klien Aktif" value="80+" icon="🤝" trend="+8%" :trendUp="true" />
        <x-data.stat-card label="Tim Developer" value="25" icon="👨‍💻" trend="+3%" :trendUp="true" />
        <x-data.stat-card label="Tahun Pengalaman" value="7" icon="🏆" trend="—" :trendUp="true" />
    </div>
</x-layout.section>

{{-- Harga --}}
<x-layout.section id="harga" title="Paket Kerjasama" subtitle="Pilih paket yang paling sesuai dengan kebutuhan tim Anda." :centered="true">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 max-w-4xl mx-auto">
        <x-custom.pricing-card plan="Basic" price="$900" :features="['1 Landing Page', 'Responsive', '1x Revisi']" />
        <x-custom.pricing-card plan="Pro" price="$2,500" :features="['Web App + API', '3x Revisi', 'Support 1 Bulan']" :popular="true" />
        <x-custom.pricing-card plan="Enterprise" price="Custom" :features="['Tim Dedicated', 'Scalable', 'Support 24/7']" />
    </div>
</x-layout.section>

{{-- FAQ --}}
<x-layout.section id="kontak" title="Pertanyaan Umum" :centered="true">
    <div class="max-w-2xl mx-auto">
        <x-layout.faq :faqs="[
            ['question' => 'Berapa lama pengerjaan proyek?', 'answer' => 'Tergantung kompleksitas: landing page 1–2 minggu, web app 4–8 minggu.'],
            ['question' => 'Apakah bisa request fitur custom?', 'answer' => 'Tentu, semua solusi kami dibangun custom sesuai kebutuhan bisnis Anda.'],
            ['question' => 'Apakah ada garansi setelah rilis?', 'answer' => 'Ya, paket Pro & Enterprise termasuk masa support setelah rilis.'],
        ]" />
    </div>
</x-layout.section>

{{-- Footer --}}
<x-layout.footer
    brand="NexaDev"
    description="Software house yang membantu bisnis tumbuh lewat produk digital."
    :links="[
        ['title' => 'Layanan', 'items' => [
            ['label' => 'Web Development', 'href' => '#layanan'],
            ['label' => 'Mobile Development', 'href' => '#layanan'],
            ['label' => 'UI/UX Design', 'href' => '#layanan'],
        ]],
        ['title' => 'Perusahaan', 'items' => [
            ['label' => 'Portofolio', 'href' => '#portofolio'],
            ['label' => 'Harga', 'href' => '#harga'],
            ['label' => 'Kontak', 'href' => '#kontak'],
        ]],
    ]"
    :socialLinks="[
        ['label' => 'GitHub', 'icon' => '🐙', 'href' => '#'],
        ['label' => 'Twitter', 'icon' => '🐦', 'href' => '#'],
        ['label' => 'LinkedIn', 'icon' => '💼', 'href' => '#'],
    ]"
    copyright="© 2026 NexaDev. All rights reserved."
/>
@endsection