# 📝 CHANGELOG

Semua perubahan penting di BacaDev Component Library dicatat di file ini.

---

## [5.5] - September 2026

### ✨ Size Scale (xs/sm/md/lg/xl) pada Form Components

Normalisasi ukuran agar seluruh komponen form konsisten memakai size scale `xs / sm / md / lg / xl`:

- **Text-entry** — Input, Password Input, Textarea, Floating Label, Input Group, Search Input, Phone Input, Currency Input, Date/Time Input, Date Picker — padding & ukuran font
- **Selection** — Select, Combobox, Auto-Complete, Multi-Select, Chip Input, Color Picker — tinggi control & teks opsi dropdown
- **Pilihan** — Checkbox, Radio, Toggle, Rating Input — ukuran kontrol + label
- **Range Slider** — tinggi track, ukuran thumb (pointer), dan teks value
- **OTP Input** — ukuran kotak & digit
- **Rich Text Editor** — padding & ukuran font area editor

### 🎨 Demo "Sizes"

- Setiap card demo form kini dilengkapi section **Sizes** dengan 5 varian ukuran.

---

## [5.4] - September 2026

### ✨ Kategori Baru: Blog (12 komponen)

- **Article Card** — kartu artikel (gambar, kategori, excerpt, author, views)
- **Article Meta** — baris info (author, tanggal, waktu baca, view count)
- **Comment** — komentar + balasan + nested replies
- **Post** — wrapper artikel detail (gambar, judul, meta, isi, tags)
- **Author Card** — bio penulis + link sosial
- **Related Posts** — artikel terkait (grid article-card)
- **Sidebar** + **Widget** — container & kartu widget
- **Category List** — daftar kategori + jumlah
- **Popular Posts** — artikel populer dengan thumbnail
- **Tag Cloud** — tag pill
- **Newsletter** — form langganan email

### ✨ Kategori Baru: Auth (4 komponen)

- **Login Card** — email + password + remember + forgot
- **Register Card** — nama + email + password + konfirmasi + terms
- **Reset Password Card** — email (minta link reset)
- **Change Password Card** — password saat ini + baru + konfirmasi

### 🐛 Perbaikan

- Dropdown select-box: `@click.outside` dipindah ke parent (auto-complete, combobox, multi-select, date-picker, select, color-picker, phone-input)

---

## [5.3] - September 2026

### ✨ Admin Template

- **Admin Layout Shell** — `layouts/admin.blade.php`: sidebar (collapsible, section header, auto-active dari route, auto-expand submenu), topbar (search ⌘K, notifikasi dropdown, dark toggle, user dropdown), page header, breadcrumb, command palette, mobile menu
- **6 Halaman Admin** — Dashboard, Users, Products, Orders, Settings, Analytics (Reports + Real-time)
- **Client-side CRUD** — tabel Users/Products dengan modal create in-memory (tanpa backend)
- **Shortcut Keyboard** — Ctrl+B toggle sidebar, Cmd+K/Ctrl+K command palette

### ✨ Component Explorer & Dokumentasi

- **Component Explorer** — halaman `/explorer` dengan playground interaktif (controls + live preview + code snippet + copy)
- **Copy + Props API konsisten** — semua card demo memakai `x-ui.demo-card`
- **x-layout.page-header** — komponen reusable judul + deskripsi + aksi halaman

### 🐛 Perbaikan

- Chart double-init ("Canvas is already in use")
- Table JSON escaping (syntax error di `<script>` tag)
- Dark mode flash (script apply tema sebelum CSS paint)
- Bottom sheet id tidak ter-register
- Rating stars non-interactive rendering
- Alpine Collapse plugin belum terpasang

### 🧹 Lainnya

- Standardisasi copy code snippet global (`codeSnippet`)
- Trim contoh demo yang redundan (varian tabel ganda, form layout, HTML layout besar)

---

## [5.2] - Juli 2026

### ✨ 3 Komponen Baru

- **Mobile Preview** — Device mockup (iPhone 15 Pro) untuk preview komponen di ukuran mobile 375px
- **Image Compare** — Before/after slider comparison dengan drag handle interaktif
- **Page Skeleton** — Full page skeleton loading dengan 3 layout: dashboard, blog, list

### 🔧 15+ Komponen Ditingkatkan

- **Table** — Search, sort, pagination, striped rows, CRUD (create/edit/view/delete modals), export CSV, print, badge columns
- **Card** — Header image, footer slot, actions slot, hover effects (lift/glow/scale/border), form-aware (asForm, auto-footer, CSRF, loading state)
- **Modal** — Focus trap, ESC close, sizes (sm/md/lg/xl/2xl/full), scroll lock, animation, accessible (aria-modal)
- **Tabs** — Animation (fade/slide), icon support, badge count, vertical variant, pills variant, full-width
- **Dropdown** — Auto-flip positioning, click trigger, hover trigger, submenu support, shortcut badges, danger variant
- **Navbar** — Mobile hamburger menu, dropdown links, search bar, notification bell, user avatar menu, variants (default/transparent/colored), scroll shadow
- **Tooltip** — 4 positions (top/bottom/left/right), arrow indicator, show/hide delay, animation
- **Alert** — Title, dismissible (animated), icon, actions slot, link, 4 types
- **Breadcrumb** — Icon per item, 8 separator options (chevron/slash/dot/arrow), collapsible (… dropdown)
- **Pagination** — First/Last buttons, ellipsis, per-page selector, showing info
- **Avatar** — Online status indicator, notification badge, bordered ring, square variant, fallback initials, size xl
- **Sidebar** — 3-level nested menu, collapsible toggle, tooltip on collapsed
- **Mobile Menu** — Multi-level expandable, user info header, FAB button, animation
- **Charts** — Chart.js integration (bar, line, doughnut, radar, polarArea), dark mode, animation, tooltips
- **Keyboard Shortcuts** — Global navigation (G+key), ? help modal, D toggle dark mode

### 🎨 Halaman Demo Enhanced

- **UI Page** — 24 komponen dengan Props API, playground, dark mode preview
- **Form Page** — 8 form layout: Login, Register, Reset Password, Profile, Checkout, Inline, Horizontal, Sections
- **Layout Page** — 10+ layout: Article List, Article Detail, Blog Home, Pricing, Team, Contact, Dashboard
- **Grid Responsif** — Semua halaman: `grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6`
- **Dark Mode** — Konsisten di semua halaman (index, home, category pages)
- **Custom Variants** — Setiap komponen punya multiple tampilan (Badge, Tag, Chip, Divider, Spinner, Skeleton, Empty State)

### 🐛 Perbaikan

- `dark:bg-gray-810` (invalid) → `dark:bg-gray-800`
- `opacity-81` (invalid) → `opacity-80`
- Dynamic Tailwind classes → color class mapping (JIT compatibility)
- Mobile menu overflow container
- User Profile component (file kosong → dibuat)

---

## [5.1] - Juli 2026

### ✨ 6 Komponen Baru

**🎨 UI (6 komponen):**
- **Share Button** — Social share buttons (Facebook, Twitter, WhatsApp, Telegram, Email, Copy Link, LinkedIn) dengan 3 varian: inline, dropdown, minimal
- **Live Code Editor** — Split-pane editor dengan live HTML preview real-time, line numbers, tombol copy & reset
- **Props Table** — Komponen reusable untuk menampilkan tabel API/props dengan type badge berwarna
- **Image Compare** — Before/after slider comparison dengan drag handle interaktif
- **Page Skeleton** — Full page skeleton loading dengan 3 layout: dashboard, blog, list

### 🔧 Peningkatan

- **Charts (Chart.js)** — Rewrite komponen charts dengan Chart.js (bar, line, doughnut, radar) + animasi, tooltips, dark mode support
- **Keyboard Shortcuts** — Navigasi global (G + key) + help modal (?) + toggle dark mode (D)
- **Props API Section** — Semua 24 card komponen kini memiliki collapsible API table (📋 Props API)
- **Props Playground** — Ditambahkan ke Share Button (variant, size, label interaktif)
- **Halaman UI** — 24 komponen tertampil lengkap dengan demo, playground, dan API documentation
- **Grid Responsive** — Semua halaman kategori diseragamkan: `grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6`
- **Dark Mode Index** — Home page dan index page dark mode ditingkatkan dengan color class mapping untuk Tailwind JIT
- **Sidebar** — Update count komponen di sidebar

### 🐛 Perbaikan

- Chip comment marker posisi diperbaiki di halaman UI
- Divider comment marker posisi diperbaiki di halaman UI
- Share Button `copyShareLink` function terdaftar di global scope
- `dark:bg-gray-810` (invalid) → `dark:bg-gray-800` di home.blade.php
- `opacity-81` (invalid) → `opacity-80` di home.blade.php
- Dynamic Tailwind classes diganti dengan color class mapping (JIT compatibility)

---

## [5.0] - Juli 2026

### ✨ 23 Komponen Baru

**🎨 UI (12 komponen):**
- Avatar Group — Avatar bertumpuk dengan overflow count
- Cookie Consent — Banner persetujuan cookie dengan posisi kustom
- Drag & Drop List — Daftar item yang bisa di-reorder
- Tree View — Hierarchical list dengan expand/collapse unlimited level
- Command Palette — Cmd+K modal search ala Spotlight
- Context Menu — Klik kanan custom menu dengan shortcut keyboard
- Scroll to Top — Tombol kembali ke atas, muncul saat scroll
- Lazy Image — Skeleton placeholder + animasi fade-in
- Countdown — Timer hitung mundur (hari/jam/menit/detik)
- Dark Mode Preview — Perbandingan light/dark side-by-side
- Notification Badge — Badge dot/count indicator
- Code Block — Syntax highlighting dengan tombol copy

**📝 Form (9 komponen):**
- Password Input — Input password dengan toggle show/hide
- OTP Input — Input kode verifikasi 6-digit dengan paste support
- Chip Input — Input tag/chip seperti email recipients
- Range Slider — Single & dual handle dengan value display
- Input Group — Input dengan prefix/suffix (ikon/teks)
- Floating Label — Label animasi ke atas saat diisi
- Toggle/Switch — On/off toggle dengan warna & ukuran
- Rating Input — Rating bintang interaktif
- Styled File Input — Input file dengan preview

**📊 Data (1 komponen):**
- Calendar — Tampilan kalender bulanan dengan event marker

**🧭 Navigation (2 komponen):**
- Stepper — Indikator langkah dengan status aktif/selesai
- Mobile Menu — Tombol FAB dengan menu panel

**🏗️ Layout (2 komponen):**
- Grid — CSS grid layout responsif
- Footer — Footer dengan links, social icons, copyright

**🔔 Feedback (1 komponen):**
- Toast Container — Sistem toast event-driven dengan posisi dinamis

### 🔧 15 Komponen Ditingkatkan

- **Spinner** — Tambah varian size (sm/md/lg/xl) & warna (blue/gray/white/green)
- **Progress Bar** — Tambah varian striped & animasi
- **Rich Text Editor** — Toolbar fungsional (Bold, Italic, Underline, List, Link)
- **Dropdown** — Ubah dari hover ke klik, tambah divider & header
- **Breadcrumb** — Tambah icon per item
- **Pagination** — Tambah prev/next + ellipsis untuk banyak halaman
- **Carousel** — Tambah autoplay, keyboard navigation, transisi slide
- **Form Wizard** — Navigasi step interaktif dengan tombol prev/next
- **Combobox** — Tambah keyboard navigation, search filter, clear button
- **Image Lightbox** — Perbaiki openLightbox stub, integrasi Alpine.js proper
- **Drawer** — Perbaiki dual x-data scope, tambah global open function
- **Bottom Sheet** — Perbaiki dual x-data scope, tambah shared state
- **Confirm Dialog** — Tambah trigger button, warning icon, animasi
- **Popover** — Tambah title support, arrow indicator, border styling
- **Navbar** — Tambah props brand, links, active state, slot actions

### 🏗️ Arsitektur

- **Alpine.js via npm** — Hapus CDN dependency, bundle dengan Vite
- **JS Components** — Pisahkan ke file terpisah di `resources/js/components/`
- **Dark Mode Toggle** — Class-based dark mode dengan localStorage
- **Halaman per Kategori** — Komponen dipisah ke 8 halaman kategori + sidebar
- **Pencarian Komponen** — Real-time search bar filtering semua komponen
- **Copy Code** — Tombol copy-to-clipboard di kartu demo
- **Props Playground** — Kontrol interaktif untuk Button & Badge

### 🧹 Pembersihan

- Hapus `kanban-board.blade.php` (duplikat)
- Perbaiki struktur dropdown (`dropdown/index.blade.php`)
- Hapus `welcome.blade.php` (72KB legacy)
- Hapus `components-demo.blade.php` (diganti halaman kategori)
- Hapus `components-simple.blade.php` (tidak terpakai)
- Perbaiki referensi `via.placeholder.com` (ganti inline SVG)
- Hapus YouTube embed (ganti placeholder)

### 🐛 Bug Fixes

- Color Picker `hslToHex` function terpotong → SyntaxError
- Accordion `x-collapse` tanpa plugin → CSS transition
- Date Picker `x-for :key` object warning → integer index
- Calendar `bg-blue-400` duplicate key → merged condition
- Form Wizard `steps` tidak ter-passing → direct x-data parameter
- Context Menu `this.$el` scope error → `var self = this`
- Tree View `node.children.length` error → null check
- Shortcut OS-aware (⌘ untuk Mac, Ctrl untuk Windows)

---

## [4.0] - 2024

### ✨ Komponen Sophisticated

**6 Komponen dengan Alpine.js Logic:**

- **Date Picker** — Kalender interaktif dengan navigasi bulan/tahun
- **Auto-Complete** — Real-time search dengan keyboard navigation
- **Multi-Select** — Komponen ala Select2 dengan tag & search
- **Image Uploader** — Drag & drop upload dengan preview & progress bar
- **Color Picker** — HSL spectrum selector dengan hue slider & presets
- **Advanced Table** — Sorting, search, pagination all-in-one

### 🎨 UI (7)
Button, Badge, Avatar, Card, Tag, Chip, Divider

### 📝 Form (18)
Input, Textarea, Select, Checkbox, Radio, Toggle, File Upload, Date Input, Time Input, DateTime Input, Search Input, Combobox, Form Wizard, Rich Text Editor, Date Picker, Auto-Complete, Multi-Select, Image Uploader, Color Picker

### 📊 Data (9)
Table, Advanced Table, Timeline, Kanban, Progress Bar, Stat Card, Chart, Carousel, Accordion

### 🧭 Navigation (8)
Navbar, Breadcrumb, Pagination, Tabs, Dropdown, Menu, Sidebar, Stepper

### 🪟 Overlay (8)
Modal, Drawer, Tooltip, Popover, Confirm Dialog, Bottom Sheet, Lightbox, Video Modal

### 🔔 Feedback (5)
Alert, Toast, Spinner, Skeleton, Empty State

### 🏗️ Layout (9)
Hero, Section, Container, Grid, Gallery, Testimonial, Pricing Table, FAQ, Footer

### 🎁 Custom (10)
Loader, Rating, Product Card, Shopping Cart, User Profile, Notification Badge, Weather Widget, Countdown, Social Links, Filter Panel

---

## [3.0] - 2024

### ✨ Ditambahkan
- Multi-Select Component (basic select multiple)
- DateTime Input Component
- Dark Mode Support (100% coverage)
- Comprehensive Demo Pages
- Component Statistics Dashboard

### 🐛 Diperbaiki
- Component namespace resolution issues
- Hardcoded localhost URLs (ganti dengan route() helpers)
- Button type attribute handling
- H3 header color contrast di light/dark mode

---

## [2.0] - 2024

### ✨ Ditambahkan
- File Upload Component
- Extended Form Components
- Overlay Components (Modal, Drawer, Tooltip, Popover)
- Navigation Components

### 🎨 Ditingkatkan
- Dark mode toggle functionality
- Responsive design di mobile
- Layout halaman demo komponen

---

## [1.0] - 2024

### 🎉 Rilis Pertama
- 59 Komponen Dasar
- Integrasi Tailwind CSS
- Alpine.js Support
- Dark Mode Support
- Responsive Design

---

## 📊 Statistik Versi

| Versi | Komponen | Fitur Baru | Status |
|-------|----------|------------|--------|
| 5.4 | 118 | Blog (12) + Auth (4) | ✅ Current |
| 5.3 | 101 | Admin template + explorer + copy/props API | ✅ Stable |
| 5.2 | 101 | 3 baru + 15 enhanced + demo | ✅ Stable |
| 5.1 | 98 | 6 baru + 5 enhanced | ✅ Stable |
| 5.0 | 95 | 23 baru + 15 enhanced | ✅ Stable |
| 4.0 | 72 | 6 sophisticated | ✅ Stable |
| 3.0 | 67 | Multi-Select + DateTime | ✅ Stable |
| 2.0 | 60 | Overlay + Navigation | ✅ Stable |
| 1.0 | 59 | Rilis Pertama | ✅ Stable |

---

## 📋 Roadmap

### Selesai ✅
- [x] Copy-to-clipboard di halaman demo
- [x] Code examples di demo
- [x] Search bar komponen
- [x] Dark mode toggle
- [x] Props playground (Button, Badge, Share Button)
- [x] Shortcut OS-aware (Mac/Windows)
- [x] Component testing suite (89 tests)
- [x] Live Code Editor dengan real-time preview
- [x] Props API table di semua komponen (collapsible)
- [x] Keyboard shortcuts navigasi global (G + key)
- [x] Chart.js integration (bar, line, doughnut, radar)
- [x] Mobile responsive preview (device mockup)
- [x] Image compare before/after slider
- [x] Full page skeleton loading (dashboard, blog, list)
- [x] Grid responsive seragam di semua halaman
- [x] Dark mode konsisten di semua halaman
- [x] TypeScript support — full conversion (strict mode, interfaces, type declarations)
- [x] Accessibility audit — ARIA, focus trap, dan arrow-key navigation (tabs, dropdown, drawer, bottom sheet, confirm dialog, modal, dll.)
- [x] Theme customization guide — THEMING.md (font, warna, dark mode, custom utility)
- [x] Component explorer (native) — halaman /explorer + komponen x-ui.playground interaktif
- [x] Admin template — layout shell + 6 halaman admin (Dashboard, Users, Products, Orders, Settings, Analytics)
- [x] Copy + Props API standardized — x-ui.demo-card di semua card demo
- [x] Blog components — 12 komponen artikel/berita (card, comment, post, sidebar widget, dsb.)
- [x] Auth components — 4 komponen form auth (login, register, reset, change password)

### Mendatang
- [ ] Visual regression testing

---

## 🙏 Penghargaan

Dibuat dengan ❤️ menggunakan:
- Laravel Framework
- Tailwind CSS
- Alpine.js
- Vite Build Tool

---

**Terakhir Diperbarui**: 3 September 2026