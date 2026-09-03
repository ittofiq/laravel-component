# 🎨 Theme Customization Guide

Panduan lengkap untuk mengubah tema visual BacaDev Component Library — warna, font, spacing, dan dark mode.

BacaDev menggunakan **Tailwind CSS v4** dengan konfigurasi berbasis CSS (bukan `tailwind.config.js`). Semua kustomisasi tema dilakukan di satu file: [resources/css/app.css](resources/css/app.css).

---

## 📍 Di Mana Tema Didefinisikan?

Tema saat ini didefinisikan di `resources/css/app.css`:

```css
@import 'tailwindcss';

@custom-variant dark (&:where(.dark, .dark *));

@theme {
    --font-sans: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif,
        'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';
}
```

- **Font** → `--font-sans` (Instrument Sans)
- **Warna** → palette default Tailwind (`blue`, `green`, `red`, `gray`, dst.) — dipakai langsung di setiap komponen
- **Dark mode** → class-based (toggle `.dark` di `<html>`)

---

## 🖋️ 1. Mengubah Font

Ganti font utama dengan menimpa `--font-sans` di `@theme`:

```css
@theme {
    --font-sans: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif;
}
```

**Langkah menambah font baru:**

1. Daftarkan font di [vite.config.js](vite.config.js) (pakai plugin Bunny Fonts):

```js
import { bunny } from 'laravel-vite-plugin/fonts';

export default defineConfig({
    plugins: [
        laravel({
            fonts: [
                bunny('Plus Jakarta Sans', {
                    weights: [400, 500, 600, 700],
                }),
            ],
        }),
    ],
});
```

2. Update `--font-sans` di `app.css`.

**Menambah font kedua (misal untuk heading):**

```css
@theme {
    --font-sans: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
    --font-display: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif;
}
```

Lalu gunakan `font-display` di komponen mana pun:

```blade
<h1 class="font-display text-4xl font-bold">Judul</h1>
```

---

## 🎨 2. Mengubah Warna

Ada dua pendekatan: **override warna default** atau **tambah warna brand baru**.

### 2a. Override Warna Default (paling cepat)

Tailwind v4 menyimpan warna sebagai CSS variable `--color-*`. Menimpa `--color-blue-500` otomatis mengubah semua `bg-blue-500`, `text-blue-500`, `border-blue-500` di seluruh komponen:

```css
@theme {
    /* Ganti blue default dengan warna brand kamu */
    --color-blue-500: #6366f1;  /* indigo */
    --color-blue-600: #4f46e5;
}
```

⚠️ **Catatan**: ini mengubah *semua* komponen yang pakai blue — praktis untuk rebranding menyeluruh, tapi bukan untuk kontrol halus per komponen.

### 2b. Tambah Warna Brand Baru (lebih aman)

Daripada menimpa, tambah warna baru dengan namespace sendiri:

```css
@theme {
    --color-brand-50: #eef2ff;
    --color-brand-100: #e0e7ff;
    --color-brand-500: #6366f1;
    --color-brand-600: #4f46e5;
    --color-brand-700: #4338ca;
}
```

Sekarang kamu bisa pakai `bg-brand-500`, `text-brand-600`, `border-brand-700`, dst. di Blade:

```blade
<x-ui.button class="bg-brand-500 hover:bg-brand-600">Submit</x-ui.button>
```

### Palet Warna yang Dipakai BacaDev

Komponen BacaDev memakai warna semantik berikut (untuk konsistensi):

| Warna | Kegunaan |
|-------|----------|
| `blue` | Aksi utama, link, focus ring |
| `green` | Sukses, status aktif |
| `red` | Error, danger, hapus |
| `yellow` | Warning, pending |
| `gray` | Teks sekunder, border, background netral |

Contoh override untuk full rebranding:

```css
@theme {
    --color-blue-50: #f0f9ff;
    --color-blue-100: #e0f2fe;
    --color-blue-500: #0ea5e9;
    --color-blue-600: #0284c7;
    --color-blue-700: #0369a1;

    --color-green-500: #22c55e;
    --color-red-500: #ef4444;
    --color-yellow-500: #eab308;
}
```

---

## 🌙 3. Dark Mode

Dark mode BacaDev adalah **class-based**. Implementasinya ada di `app.css`:

```css
@custom-variant dark (&:where(.dark, .dark *));
```

Artinya: utility `dark:` aktif selama elemen `<html>` punya class `.dark`. Toggle-nya di-handle komponen `darkMode` ([resources/js/components/dark-mode.ts](resources/js/components/dark-mode.ts)).

### Mencegah Flash Tema (Anti-FOUC)

Supaya tidak ada flash tema salah (light muncul sesaat sebelum dark), kedua layout (`layouts/app.blade.php` dan `layouts/admin.blade.php`) punya script inline di `<head>` yang menaruh class `.dark` ke `<html>` **sebelum CSS diproses**:

```html
<script>
    (function () {
        var t = localStorage.getItem('theme');
        if (t === 'dark' || (!t && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    })();
</script>
```

Script ini membaca preferensi yang sama dengan `darkMode`, jadi toggle dan load awal selalu konsisten.

### Mengubah Warna Dark Mode

Semua warna dark mode di komponen memakai prefix `dark:`, contoh `bg-gray-800 dark:bg-gray-900`. Untuk kustomisasi, override token yang relevan:

```css
@theme {
    /* Background dark default */
    --color-gray-800: #171717;
    --color-gray-900: #0a0a0a;
}
```

### Menambah Komponen Custom dengan Dark Mode

```blade
<div class="bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">
    Konten
</div>
```

Aturan: **selalu sediakan pasangan light/dark** untuk setiap warna.

---

## 📐 4. Spacing, Radius, dan Token Lain

Semua token Tailwind bisa di-override lewat `@theme`:

```css
@theme {
    /* Radius default lebih bulat */
    --radius-lg: 1rem;
    --radius-xl: 1.25rem;

    /* Spacing custom */
    --spacing-18: 4.5rem;
    --spacing-22: 5.5rem;
}
```

`--spacing-18` otomatis membuat utility `p-18`, `m-18`, `gap-18`, dst.

---

## 🧩 5. Menambah Custom Utility & Component Class

Untuk pola yang berulang, tambahkan `@utility` atau `@layer components`:

```css
/* Utility custom */
@utility text-gradient {
    background: linear-gradient(to right, #6366f1, #8b5cf6);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* Component class reusable */
@layer components {
    .btn-brand {
        @apply bg-brand-500 text-white rounded-lg px-4 py-2 hover:bg-brand-600 transition-colors;
    }
}
```

Lalu pakai `text-gradient` atau `btn-brand` langsung di Blade.

---

## 🚀 Contoh Lengkap: Rebranding ke Warna Ungu

Berikut contoh lengkap mengubah BacaDev ke aksen ungu:

**`resources/css/app.css`:**
```css
@import 'tailwindcss';

@custom-variant dark (&:where(.dark, .dark *));

@theme {
    --font-sans: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif;

    /* Override blue → purple */
    --color-blue-50: #faf5ff;
    --color-blue-100: #f3e8ff;
    --color-blue-500: #a855f7;
    --color-blue-600: #9333ea;
    --color-blue-700: #7e22ce;
}
```

Karena komponen BacaDev sudah konsisten memakai `blue` untuk aksi utama, cukup menimpa `--color-blue-*` dan seluruh library otomatis berubah ke ungu.

---

## ✅ Checklist Setelah Ubah Tema

1. **Build ulang CSS** — `npm run build`
2. **Cek dark mode** — toggle di navbar, pastikan kontras tetap baik
3. **Cek fokus** — tab melalui form, pastikan focus ring terlihat
4. **Cek responsif** — buka di ukuran mobile, pastikan tidak ada warna yang pecah
5. **Jalankan test** — `php artisan test`

---

## 📚 Referensi

- [Tailwind CSS v4 Theme Variables](https://tailwindcss.com/docs/theme)
- [Tailwind CSS v4 Dark Mode](https://tailwindcss.com/docs/dark-mode)
- [Tailwind CSS v4 Custom Variants](https://tailwindcss.com/docs/adding-custom-styles)
- [Bunny Fonts](https://fonts.bunny.net)