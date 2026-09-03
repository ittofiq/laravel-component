# 📋 Component List & Usage Guide

> ✨ **Admin Template** — lihat `http://localhost:8000/admin` untuk contoh penggunaan komponen dalam template admin siap pakai (Dashboard, Users, Products, Orders, Settings, Analytics). Layout shell di `resources/views/layouts/admin.blade.php`.

## Helper Components (untuk dokumentasi/demo/template)

- `x-layout.page-header` — header halaman (judul + deskripsi + slot aksi)
- `x-ui.demo-card` — card demo seragam (judul + tombol copy + Props API)
- `x-ui.playground` — playground interaktif (controls + live preview + code snippet)
- `x-ui.props-table` — tabel Props API (name/type/default/description)

---

## 🎨 UI Components (24)

### 1. Button
```blade
<x-ui.button variant="primary">Primary</x-ui.button>
<x-ui.button variant="secondary">Secondary</x-ui.button>
<x-ui.button variant="danger">Danger</x-ui.button>
<x-ui.button variant="success">Success</x-ui.button>
<x-ui.button size="sm">Small</x-ui.button>
<x-ui.button size="lg">Large</x-ui.button>
<x-ui.button disabled>Disabled</x-ui.button>
```

### 2. Badge
```blade
<x-ui.badge variant="primary">Primary</x-ui.badge>
<x-ui.badge variant="success">Success</x-ui.badge>
<x-ui.badge variant="danger">Danger</x-ui.badge>
<x-ui.badge variant="warning">Warning</x-ui.badge>
<x-ui.badge size="sm">Small</x-ui.badge>
<x-ui.badge size="lg">Large</x-ui.badge>
```

### 3. Avatar
```blade
<x-ui.avatar initials="JD" size="sm" />
<x-ui.avatar initials="AB" size="md" color="blue" />
<x-ui.avatar initials="CD" size="lg" color="red" />
```

### 4. Card
```blade
<x-ui.card title="Card Title" subtitle="Subtitle">
  Card content here
</x-ui.card>
```

### 5. Tag
```blade
<x-ui.tag variant="primary">Tag 1</x-ui.tag>
<x-ui.tag variant="secondary" removable>Removable Tag</x-ui.tag>
```

### 6. Chip
```blade
<x-ui.chip removable>Chip with X</x-ui.chip>
```

### 7. Divider
```blade
<x-ui.divider />
<x-ui.divider text="OR" />
```

### 8. Avatar Group
```blade
<x-ui.avatar-group :avatars="[
    ['initials' => 'JD'], ['initials' => 'AB'], ['initials' => 'CD']
]" :max="4" size="md" />
```

### 9. Cookie Consent
```blade
<x-ui.cookie-consent 
    message="Kami menggunakan cookie..."
    position="bottom"
    acceptText="Terima"
    declineText="Tolak"
/>
```

### 10. Share Button
```blade
<x-ui.share-button url="https://example.com" title="My Page" />
<x-ui.share-button variant="dropdown" label="Bagikan" />
<x-ui.share-button variant="minimal" size="sm" />
<x-ui.share-button :platforms="['linkedin', 'facebook', 'twitter']" />
```

### 11. Drag & Drop List
```blade
<x-ui.drag-drop-list :items="[
    ['id' => '1', 'label' => 'Item 1', 'description' => 'Drag me'],
    ['id' => '2', 'label' => 'Item 2', 'description' => 'Drop here']
]" :sortable="true" />
```

### 12. Tree View
```blade
<x-ui.tree-view :items="[
    ['id' => '1', 'label' => 'src', 'children' => [
        ['id' => '1.1', 'label' => 'App.jsx']
    ]],
    ['id' => '2', 'label' => 'package.json']
]" icon="📁" openIcon="📂" fileIcon="📄" />
```

### 13. Command Palette
```blade
<x-ui.command-palette :items="[
    ['id' => '1', 'label' => 'Dashboard', 'icon' => '📊', 'shortcut' => 'G D', 'color' => 'blue'],
    ['id' => '2', 'label' => 'Settings', 'icon' => '⚙️', 'shortcut' => 'G S']
]" placeholder="Search commands..." />
```

### 14. Context Menu
```blade
<x-ui.context-menu :items="[
    ['label' => 'Edit', 'icon' => '✏️', 'shortcut' => '⌘E'],
    ['divider' => true],
    ['label' => 'Delete', 'icon' => '🗑️', 'danger' => true]
]">
    <div class="p-8 border-2 border-dashed rounded-lg">
        Klik kanan di area ini
    </div>
</x-ui.context-menu>
```

### 15. Scroll to Top
```blade
<x-ui.scroll-to-top color="blue" position="bottom-right" :showAt="300" />
```

### 16. Lazy Image
```blade
<x-ui.lazy-image src="/image.jpg" alt="Example" ratio="16/9" rounded="rounded-lg" />
<x-ui.lazy-image src="/avatar.jpg" alt="Square" ratio="1/1" />
```

### 17. Countdown
```blade
<x-ui.countdown 
    target="2026-12-31 23:59:59" 
    label="Launching in" 
    size="md" 
    variant="boxes"
    :showSeconds="true"
/>
```

### 18. Dark Mode Preview
```blade
<x-ui.dark-mode-preview label="Component Preview">
    <x-ui.button variant="primary">Button</x-ui.button>
</x-ui.dark-mode-preview>
```

### 19. Notification Badge
```blade
<x-ui.notification-badge :count="3">
    <svg><!-- Bell icon --></svg>
</x-ui.notification-badge>
<x-ui.notification-badge :dot="true" color="green">
    <span>Online</span>
</x-ui.notification-badge>
```

### 20. Code Block
```blade
<x-ui.code-block 
    code="&lt;x-ui.button&gt;Click&lt;/x-ui.button&gt;"
    language="blade"
    filename="button.blade.php"
    :showLineNumbers="true"
    :showCopy="true"
/>
```

### 21. Live Code Editor
```blade
<x-ui.live-code-editor 
    label="Live Code Editor"
    defaultCode="<button class='bg-blue-500 text-white px-4 py-2 rounded-lg'>Click</button>"
    height="320px"
/>
```

### 22. Mobile Preview
```blade
<x-ui.mobile-preview label="Mobile Preview" device="iPhone 15 Pro" width="375px">
    <x-ui.button variant="primary">Button</x-ui.button>
    <x-ui.badge variant="success">Badge</x-ui.badge>
</x-ui.mobile-preview>
```

### 23. Image Compare
```blade
<x-ui.image-compare
    label="Before vs After"
    before="/path/to/before.jpg"
    after="/path/to/after.jpg"
    ratio="16/9"
    :initial="50"
/>
```

### 24. Page Skeleton
```blade
<x-ui.page-skeleton :loading="true" layout="dashboard">
    <!-- Konten asli setelah loading -->
    <div>Your page content</div>
</x-ui.page-skeleton>
```

---

## 📝 Form Components (27)

### Basic Inputs
```blade
<x-form.input name="text" label="Text Input" placeholder="Type here..." />
<x-form.input name="email" type="email" label="Email" />
<x-form.input name="password" type="password" label="Password" />
<x-form.input-group name="url" label="URL" prefix="https://" placeholder="example.com" />
<x-form.textarea name="message" label="Message" rows="5" />
```

### Selection
```blade
<x-form.select name="option" label="Choose Option" :options="['a' => 'Option A', 'b' => 'Option B']" />
<x-form.checkbox name="agree" label="I agree" />
<x-form.radio name="choice" value="yes" label="Yes" />

<!-- Toggle -->
<x-form.toggle name="notifications" label="Enable Notifications" :checked="true" />
<x-form.toggle name="dark_mode" label="Dark Mode" color="green" size="lg" />
```

### Date & Time
```blade
<x-form.date-input name="date" label="Date (mm/dd/yyyy)" />
<x-form.time-input name="time" label="Time (hh:mm)" />
<x-form.datetime-input name="datetime" label="Date & Time" />
```

### Sophisticated Components 🆕
```blade
<!-- Date Picker dengan Calendar UI -->
<x-form.date-picker name="birthdate" label="Tanggal Lahir" required />

<!-- Auto-Complete dengan Search -->
<x-form.auto-complete 
  name="country"
  label="Pilih Negara"
  :options="['Indonesia', 'Malaysia', 'Singapore', 'Thailand']"
/>

<!-- Multi-Select (Select2-like) -->
<x-form.multi-select 
  name="skills"
  label="Select Skills"
  :options="['js' => 'JavaScript', 'php' => 'PHP', 'python' => 'Python']"
/>

<!-- Image Uploader -->
<x-form.image-uploader 
  name="avatar"
  label="Upload Foto"
  maxSize="5242880"
/>

<!-- Color Picker -->
<x-form.color-picker 
  name="theme_color"
  label="Pilih Warna"
  value="#3B82F6"
/>

<!-- File Upload -->
<x-form.file-upload name="document" label="Upload File" accept=".pdf,.doc,.docx" />

<!-- Search Input -->
<x-form.search-input name="search" label="Search" />

<!-- Combobox -->
<x-form.combobox name="category" label="Category" :options="['a', 'b', 'c']" />

<!-- Form Wizard -->
<x-form.form-wizard :steps="['Step 1', 'Step 2', 'Step 3']" />

<!-- Rich Text Editor -->
<x-form.rich-text-editor name="content" label="Content" />
```

---

## 📊 Data Components (9)

### Table
```blade
<x-data.table 
  :headers="['Name', 'Email', 'Status']"
  :rows="[
    ['John', 'john@example.com', 'Active'],
    ['Jane', 'jane@example.com', 'Active']
  ]"
/>
```

### Advanced Table 🆕
```blade
<x-data.advanced-table
  :headers="[
    ['key' => 'name', 'label' => 'Name'],
    ['key' => 'email', 'label' => 'Email'],
    ['key' => 'status', 'label' => 'Status']
  ]"
  :rows="$users"
  :itemsPerPage="10"
/>
<!-- Features: Sorting, Search, Pagination -->
```

### Timeline
```blade
<x-data.timeline 
  :items="[
    ['title' => 'Event 1', 'date' => 'Today', 'content' => 'Completed'],
    ['title' => 'Event 2', 'date' => 'Tomorrow', 'content' => 'Pending']
  ]"
/>
```

### Kanban 🆕
```blade
<x-data.kanban
  :columns="[
    [
      'title' => 'To Do',
      'items' => [
        ['title' => 'Task 1', 'description' => 'Do something', 'priority' => 'High', 'assignee' => 'John'],
        ['title' => 'Task 2', 'description' => 'Do another', 'priority' => 'Medium', 'assignee' => 'Jane']
      ]
    ],
    [
      'title' => 'In Progress',
      'items' => [...]
    ]
  ]"
/>
```

### Progress Bar
```blade
<x-data.progress-bar :percent="60" showLabel />
<x-data.progress-bar :percent="80" color="blue" />
```

### Stat Card
```blade
<x-data.stat-card label="Users" value="1.2K" icon="👥" />
<x-data.stat-card label="Revenue" value="$12K" icon="💰" color="green" />
```

### Charts
```blade
<x-data.charts type="bar" label="Sales" :data="[
  ['label' => 'Jan', 'value' => 60],
  ['label' => 'Feb', 'value' => 80]
]" />
```

### Card Grid
```blade
<x-data.card-grid 
  title="Product Name"
  price="99.99"
  image="/product.jpg"
  :rating="4"
/>
```

---

## 🧭 Navigation Components (9)

```blade
<!-- Navbar -->
<x-navigation.navbar brand="BacaDev" :links="['Home', 'Features', 'Contact']" />

<!-- Breadcrumb -->
<x-navigation.breadcrumb :items="['Home', 'Products', 'Category', 'Item']" />

<!-- Pagination -->
<x-navigation.pagination :total="100" :perPage="10" currentPage="1" />

<!-- Tabs -->
<x-navigation.tabs :tabs="['Tab 1', 'Tab 2', 'Tab 3']" />

<!-- Dropdown -->
<x-navigation.dropdown label="Menu">
  <x-navigation.dropdown.item href="#">Option 1</x-navigation.dropdown.item>
  <x-navigation.dropdown.item href="#">Option 2</x-navigation.dropdown.item>
</x-navigation.dropdown>

<!-- Mobile Menu -->
<x-navigation.mobile-menu :items="[
  ['id' => 'home', 'label' => 'Home', 'href' => '/'],
  ['id' => 'about', 'label' => 'About', 'href' => '/about']
]" />

<!-- Sidebar -->
<x-navigation.sidebar :links="['Home', 'Settings', 'Logout']" />
```

---

## 🪟 Overlay Components (8)

```blade
<!-- Modal -->
<x-overlay.modal id="myModal" title="Modal Title">
  <p>Modal content</p>
</x-overlay.modal>

<!-- Drawer -->
<x-overlay.drawer id="myDrawer" title="Drawer Title" position="right">
  <p>Drawer content</p>
</x-overlay.drawer>

<!-- Tooltip -->
<x-overlay.tooltip text="Tooltip text">Hover me</x-overlay.tooltip>

<!-- Popover -->
<x-overlay.popover title="Popover Title">
  <p>Popover content</p>
</x-overlay.popover>

<!-- Confirm Dialog -->
<x-overlay.confirm-dialog id="confirm" title="Confirm" message="Are you sure?" />

<!-- Bottom Sheet -->
<x-overlay.bottom-sheet id="sheet" title="Sheet Title">
  <p>Sheet content</p>
</x-overlay.bottom-sheet>

<!-- Image Lightbox -->
<x-overlay.image-lightbox :images="['/img1.jpg', '/img2.jpg']" />

<!-- Video Modal -->
<x-overlay.video-modal id="video" src="https://youtube.com/embed/..." />
```

---

## 🔔 Feedback Components (6)

```blade
<!-- Alert -->
<x-feedback.alert type="success" title="Success" message="Operation successful" />
<x-feedback.alert type="error" title="Error" message="Something went wrong" />
<x-feedback.alert type="warning" title="Warning" message="Be careful" />
<x-feedback.alert type="info" title="Info" message="Information" />

<!-- Toast (Standalone) -->
<x-feedback.toast type="success" message="Saved!" position="top-right" />
<x-feedback.toast type="error" message="Failed!" position="top-right" :duration="3000" />
<x-feedback.toast type="warning" message="Warning!" position="bottom-left" />
<x-feedback.toast type="info" message="Update available" position="top-center" />

<!-- Toast Container (Event-Driven) -->
<x-feedback.toast-container position="top-right" />
<!-- Trigger dari mana saja: -->
<button onclick="window.showToast({ type: 'success', title: 'Berhasil!', message: 'Data tersimpan.' })">
  Simpan
</button>

<!-- Spinner -->
<x-feedback.spinner size="md" color="blue" />

<!-- Skeleton -->
<x-feedback.skeleton type="text" :count="3" />
<x-feedback.skeleton type="paragraph" :count="5" />
<x-feedback.skeleton type="image" :width="300" :height="200" />
<x-feedback.skeleton type="circle" size="md" />
<x-feedback.skeleton type="card" :count="3" />
<x-feedback.skeleton type="profile" size="md" />
<x-feedback.skeleton type="table-row" :count="3" />

<!-- Empty State -->
<x-feedback.empty-state icon="📭" title="No Data" message="No items found" />
```

---

## 🏗️ Layout Components (11)

```blade
<!-- Hero -->
<x-layout.hero 
  title="Welcome to BacaDev"
  subtitle="Build faster with components"
/>

<!-- Section -->
<x-layout.section title="Features" class="py-12">
  Content here
</x-layout.section>

<!-- Container -->
<x-layout.container>
  Centered content
</x-layout.container>

<!-- Grid -->
<x-layout.grid :cols="3" gap="4">
  @foreach($items as $item)
    <div>{{ $item }}</div>
  @endforeach
</x-layout.grid>

<!-- Image Gallery -->
<x-layout.image-gallery :images="$images" :columns="3" />

<!-- Accordion -->
<x-layout.accordion 
  :items="[
    ['title' => 'Section 1', 'content' => 'Content 1'],
    ['title' => 'Section 2', 'content' => 'Content 2']
  ]"
/>

<!-- Carousel -->
<x-layout.carousel :items="$slides" />

<!-- Masonry Grid -->
<x-layout.masonry-grid :items="[
  ['image' => '/img1.jpg', 'title' => 'Item 1', 'description' => 'Desc 1']
]" />

<!-- Waterfall Layout -->
<x-layout.waterfall-layout :items="[
  ['image' => '/img1.jpg', 'title' => 'Item 1', 'description' => 'Desc 1']
]" />
```

---

## 🎁 Custom Components (8)

```blade
<!-- Loader -->
<x-custom.loader size="lg" color="blue" />

<!-- Rating Stars -->
<x-custom.rating-stars :value="4" :max="5" />

<!-- Shopping Cart -->
<x-custom.shopping-cart :items="$cartItems" />

<!-- User Profile -->
<x-custom.user-profile 
  avatar="/avatar.jpg"
  name="John Doe"
  email="john@example.com"
/>

<!-- Permission System -->
<x-custom.permission-system :roles="[
  ['name' => 'Admin', 'permissions' => [
    ['name' => 'Create', 'granted' => true],
    ['name' => 'Edit', 'granted' => true]
  ]]
]" />

<!-- Pricing Card -->
<x-custom.pricing-card 
  plan="Pro"
  price="$29"
  :features="['Feature 1', 'Feature 2']"
  :popular="true"
/>

<!-- Protected Button -->
<x-custom.protected-button permission="edit-post">
  Edit Post
</x-custom.protected-button>

<!-- 2FA Authentication -->
<x-custom.two-fa-auth :step="1" />
```

---

## 🎯 Common Props

Kebanyakan komponen support props berikut:

```blade
<!-- Label -->
<x-form.input label="Label" />

<!-- Placeholder -->
<x-form.input placeholder="Enter value..." />

<!-- Required -->
<x-form.input required />

<!-- Disabled -->
<x-form.input disabled />

<!-- Error Message -->
<x-form.input error="Field is required" />

<!-- Custom Classes -->
<x-form.input class="custom-class" />
```

---

## 📰 Blog Components (12)

```blade
{{-- Article Card --}}
<x-blog.article-card
    title="Judul Artikel" excerpt="Ringkasan singkat..."
    image="https://..." category="Web Development" categoryColor="blue"
    author="Andi Wijaya" date="12 Agustus 2026" readTime="6" views="1.2K"
/>

{{-- Post (detail) --}}
<x-blog.post title="Judul Artikel" category="Web Development" author="Andi" :tags="['Laravel', 'Tailwind']">
    <p>Isi artikel...</p>
</x-blog.post>

{{-- Comment + balasan --}}
<x-blog.comment name="Budi" time="2 jam lalu" text="Komentar...">
    <x-slot:replies>
        <x-blog.comment name="Andi" text="Balasan..." :author="true" />
    </x-slot:replies>
</x-blog.comment>

{{-- Sidebar + widget --}}
<x-blog.sidebar>
    <x-blog.widget title="Kategori" icon="📂">
        <x-blog.category-list :categories="[['name' => 'Web Dev', 'count' => 12]]" />
    </x-blog.widget>
    <x-blog.widget title="Tags" icon="🏷️">
        <x-blog.tag-cloud :tags="['Laravel', 'Tailwind', 'Vue']" />
    </x-blog.widget>
</x-blog.sidebar>
```

## 🔐 Auth Components (4)

```blade
<x-auth.login-card title="Sign In" submitLabel="Masuk" />
<x-auth.register-card title="Buat Akun" submitLabel="Daftar" />
<x-auth.reset-password-card title="Reset Password" />
<x-auth.change-password-card title="Ubah Password" />
```

---

## 📊 Summary

| Category | Count | Components |
|----------|-------|------------|
| UI | 24 | Button, Badge, Avatar, Avatar Group, Cookie Consent, Share Button, Drag & Drop List, Tree View, Command Palette, Context Menu, Scroll to Top, Lazy Image, Countdown, Dark Mode Preview, Notification Badge, Code Block, Live Code Editor, Card, Tag, Chip, Divider, Mobile Preview, Image Compare, Page Skeleton |
| Form | 27 | Input, Password Input, OTP Input, Chip Input, Range Slider, Input Group, Floating Label, Textarea, Select, Checkbox, Radio, Toggle, Date Input, Time Input, DateTime Input, Date Picker, Auto-Complete, Multi-Select, Image Uploader, Color Picker, File Upload, Styled File Input, Search Input, Combobox, Form Wizard, Rating Input, Rich Text Editor |
| Data | 9 | Table, Advanced Table, Timeline, Kanban, Calendar, Progress Bar, Stat Card, Charts (Chart.js), Card Grid |
| Navigation | 9 | Navbar, Breadcrumb, Pagination, Tabs, Stepper, Dropdown, Dropdown Item, Mobile Menu, Sidebar |
| Overlay | 8 | Modal, Drawer, Tooltip, Popover, Confirm Dialog, Bottom Sheet, Image Lightbox, Video Modal |
| Feedback | 6 | Alert, Toast, Toast Container, Spinner, Skeleton, Empty State |
| Layout | 11 | Hero, Section, Container, Grid, Footer, FAQ, Image Gallery, Accordion, Carousel, Masonry Grid, Waterfall Layout |
| Custom | 8 | Loader, Rating Stars, Shopping Cart, User Profile, Permission System, Pricing Card, Protected Button, 2FA Auth |
| Blog | 12 | Article Card, Article Meta, Comment, Post, Author Card, Related Posts, Sidebar, Widget, Category List, Popular Posts, Tag Cloud, Newsletter |
| Auth | 4 | Login Card, Register Card, Reset Password Card, Change Password Card |
| **Total** | **118** | |

---

**View full demo at: http://localhost:8000/components**