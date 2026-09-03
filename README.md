# 🎨 BacaDev Component Library

**Production-ready Tailwind CSS Component Library untuk Laravel**

![Version](https://img.shields.io/badge/version-5.3-blue.svg)
![Components](https://img.shields.io/badge/components-101-green.svg)
![License](https://img.shields.io/badge/license-MIT-orange.svg)

---

## 📊 Library Overview

BacaDev adalah component library dengan **101 production-ready komponen** yang dibangun menggunakan:
- **Tailwind CSS 4.0** - Utility-first styling
- **Laravel Blade** - Template engine
- **Alpine.js** - Lightweight interactivity
- **Minimal Dependencies** - Tailwind CSS + Alpine.js + Chart.js

### ✨ Fitur Utama

✅ **101 Komponen** - UI, Form, Data, Navigation, Overlay, Feedback, Layout, Custom  
✅ **100% Dark Mode** - Full support di semua komponen  
✅ **Fully Responsive** - Mobile-first design  
✅ **Minimal Dependencies** - Tailwind CSS, Alpine.js & Chart.js  
✅ **Production Ready** - Tested & optimized  
✅ **Easy to Use** - Simple Blade syntax: `<x-component-name />`  
✅ **Keyboard Shortcuts** - Navigasi global (G + key) + panduan (?)  
✅ **Chart.js** - Visualisasi data interaktif (bar, line, doughnut, radar)  
✅ **Admin Template** - 6 halaman admin siap pakai (Dashboard, Users, Products, Orders, Settings, Analytics)  
✅ **Component Explorer** - Playground interaktif di /explorer  

---

## 🚀 Quick Start

### 1. Setup Project

```bash
# Clone repository
git clone <repo-url>
cd bacadev

# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate
```

### 2. Run Dev Servers

**Terminal 1** - Laravel Server:
```bash
php artisan serve
```

**Terminal 2** - Vite Dev Server:
```bash
npm run dev
```

Akses: http://localhost:8000

### 3. View Components

- **Full Showcase**: http://localhost:8000/components
- **Demo Hub**: http://localhost:8000/demo
- **Home Page**: http://localhost:8000
- **Admin Template**: http://localhost:8000/admin
- **Component Explorer**: http://localhost:8000/explorer

---

## 📂 Komponen Categories

### 🎨 UI Components (24)
Button, Badge, Avatar, Avatar Group, Card, Tag, Chip, Divider, Cookie Consent, Share Button, Drag & Drop List, Tree View, Command Palette, Context Menu, Scroll to Top, Lazy Image, Countdown, Dark Mode Preview, Notification Badge, Code Block, Mobile Preview, Image Compare, Page Skeleton

### 📝 Form Components (27)
Input, Textarea, Select, Checkbox, Radio, Date Picker, Auto-Complete, Multi-Select, Image Uploader, Color Picker, Password Input, OTP Input, Chip Input, Range Slider, Input Group, Floating Label, Toggle, Rating Input, Styled File Input, dan lainnya

### 📊 Data Components (9)
Table, Advanced Table, Timeline, Kanban, Calendar, Progress Bar, Stat Card, Charts, Card Grid

### 🧭 Navigation (9)
Navbar, Breadcrumb, Pagination, Tabs, Stepper, Dropdown, Dropdown Item, Mobile Menu, Sidebar

### 🪟 Overlay (8)
Modal, Drawer, Tooltip, Popover, Confirm Dialog, Bottom Sheet, Image Lightbox, Video Modal

### 🔔 Feedback (6)
Alert, Toast, Toast Container, Spinner, Skeleton, Empty State

### 🏗️ Layout (11)
Hero, Section, Container, Grid, Footer, FAQ, Image Gallery, Accordion, Carousel, Masonry Grid, Waterfall Layout

### 🎁 Custom (8)
Loader, Rating Stars, Shopping Cart, User Profile, Permission System, Pricing Card, Protected Button, 2FA Auth

---

## 💡 Penggunaan

### Basic Components

```blade
<!-- Button -->
<x-ui.button variant="primary">Click Me</x-ui.button>

<!-- Input -->
<x-form.input name="email" label="Email" placeholder="user@example.com" required />

<!-- Modal -->
<x-overlay.modal id="myModal" title="Modal Title">
  <p>Modal content</p>
</x-overlay.modal>
```

### Sophisticated Components 🆕

```blade
<!-- Date Picker dengan Calendar -->
<x-form.date-picker name="birthdate" label="Tanggal Lahir" required />

<!-- Auto-Complete dengan Search -->
<x-form.auto-complete 
  name="country" 
  :options="['Indonesia', 'Malaysia', 'Singapore']" 
/>

<!-- Multi-Select (Select2-like) -->
<x-form.multi-select 
  name="skills"
  :options="['js' => 'JavaScript', 'php' => 'PHP', 'python' => 'Python']"
/>

<!-- Image Uploader dengan Drag & Drop -->
<x-form.image-uploader name="avatar" label="Upload Foto" maxSize="5242881" />

<!-- Color Picker dengan HSL Spectrum -->
<x-form.color-picker name="color" label="Pilih Warna" value="#3B82F6" />

<!-- Advanced Table dengan Sorting & Pagination -->
<x-data.advanced-table
  :headers="[
    ['key' => 'name', 'label' => 'Name'],
    ['key' => 'email', 'label' => 'Email'],
    ['key' => 'status', 'label' => 'Status']
  ]"
  :rows="$users"
  :itemsPerPage="10"
/>

<!-- Kanban Board dengan Drag & Drop -->
<x-data.kanban
  :columns="[
    ['title' => 'To Do', 'items' => [...]],
    ['title' => 'In Progress', 'items' => [...]]
  ]"
/>
```

---

## 🆕 Sophisticated Components (v5.1)

**7 komponen advanced dengan interactive logic berbasis Alpine.js:**

### 1. Date Picker
Interactive calendar dengan month/year navigation, today button, dan full keyboard support.

### 2. Auto-Complete
Real-time search filtering dengan keyboard navigation (↑↓ Enter Escape) dan suggestion dropdown.

### 3. Multi-Select (Select2-like)
Search & filter options, tag-based selection, click to select/deselect tanpa checkbox.

### 4. Image Uploader
Drag & drop upload, image preview, file validation, progress bar, dan file info display.

### 5. Color Picker
HSL spectrum selector dengan hue slider, saturation/value controls, dan preset colors.

### 6. Advanced Table
Sorting by clicking header, real-time search across all columns, pagination dengan prev/next buttons.

### 7. Kanban Board
Drag & drop between columns, card display dengan metadata, task counter per column.

---

## ✨ Key Features

### Dark Mode
Semua komponen fully support dark mode dengan Tailwind dark: prefix

### Responsive Design
Mobile-first approach dengan Tailwind breakpoints (sm, md, lg, xl, 2xl)

### Error Handling
```blade
<x-form.input name="email" error="Email tidak valid" />
```

### Disabled State
```blade
<x-ui.button disabled>Disabled</x-ui.button>
<x-form.input disabled />
```

### Common Props
- `label` - Input label
- `placeholder` - Placeholder text
- `required` - Required field
- `disabled` - Disabled state
- `error` - Error message
- `class` - Custom Tailwind classes

---

## 📊 Statistics

| Metric | Value |
|--------|-------|
| Total Components | 101 |
| UI Components | 24 |
| Form Components | 27 |
| Data Components | 9 |
| Navigation Components | 9 |
| Overlay Components | 8 |
| Feedback Components | 6 |
| Layout Components | 11 |
| Custom Components | 8 |
| Dark Mode Support | 100% |
| Responsive Breakpoints | 5 |
| External Dependencies | Alpine.js + Chart.js |

---

## 🛠️ Development

### Tech Stack
- **Backend**: Laravel 13.8
- **Frontend**: Tailwind CSS 4.0, Alpine.js 3.x
- **Build Tool**: Vite
- **Package Manager**: npm, Composer

### Adding New Component

1. Create file: `resources/views/components/category/component-name.blade.php`
2. Define props dengan `@props([])`
3. Build HTML dengan Tailwind classes
4. Use: `<x-category.component-name />`

---

**Happy coding! 🚀**
