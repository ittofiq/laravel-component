# 🚀 Installation & Setup Guide

## Prerequisites

- PHP 8.3+ 
- Node.js 16+
- Composer
- Git

---

## 📥 Installation Steps

### 1. Clone Repository

```bash
git clone <repository-url>
cd bacadev
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Node Dependencies

```bash
npm install
```

### 4. Setup Environment File

```bash
cp .env.example .env
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Configure Database (Optional)

Edit `.env` file untuk database configuration jika diperlukan:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bacadev
DB_USERNAME=root
DB_PASSWORD=
```

---

## 🏃 Running the Application

### Terminal 1 - Start Laravel Server

```bash
php artisan serve
```

Server akan run di: **http://localhost:8000**

### Terminal 2 - Start Vite Dev Server

```bash
npm run dev
```

Vite akan compile Tailwind CSS dan JavaScript.

---

## 🌐 Access Demo Pages

Setelah kedua server berjalan, buka browser:

- **Homepage**: http://localhost:8000
- **Component Showcase**: http://localhost:8000/components
- **Demo Hub**: http://localhost:8000/demo

---

## 📦 Production Build

### Build CSS & JS

```bash
npm run build
```

### Optimize Laravel

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Deploy

```bash
# Using Heroku
git push heroku main

# Using other platforms
# Follow your platform's deployment guide
```

---

## 🔧 Configuration

### Tailwind Configuration

Tailwind v4 menggunakan CSS-based configuration. Theme dikonfigurasi di `resources/css/app.css`:

```css
@import 'tailwindcss';

@theme {
    --font-sans: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
}

@custom-variant dark (&:where(.dark, .dark *));
```

Untuk custom theme, tambahkan variabel CSS di dalam blok `@theme`.

### Vite Configuration

File: `vite.config.js`

```javascript
import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'

export default defineConfig({
  plugins: [
    laravel([
      'resources/css/app.css',
      'resources/js/app.js',
    ]),
  ],
})
```

---

## 🛠️ Development Commands

```bash
# Start dev server
npm run dev

# Build for production
npm run build

# Run tests
php artisan test

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Database migration
php artisan migrate
```

---

## 🐛 Troubleshooting

### Port 8000 Already in Use

```bash
# Use different port
php artisan serve --port=8001
```

### Node modules issues

```bash
# Clean and reinstall
rm -rf node_modules package-lock.json
npm install
```

### Composer issues

```bash
# Clear composer cache
composer clearcache

# Reinstall dependencies
composer install --no-scripts
```

### Vite not compiling CSS

```bash
# Restart Vite dev server
npm run dev

# Ensure resources/css/app.css is properly configured
```

---

## ✅ Verify Installation

1. **Check Laravel**: http://localhost:8000 should load homepage
2. **Check Components**: http://localhost:8000/components should show all 101 components
3. **Check Dark Mode**: Toggle dark mode switch in navbar
4. **Test Interactive Component**: Try Date Picker, Multi-Select, etc.

---

## 📚 Directory Structure

```
bacadev/
├── app/                        # Laravel app code
├── resources/
│   ├── views/
│   │   ├── components/         # 101 Blade components
│   │   ├── layouts/
│   │   └── pages/              # Demo pages
│   ├── css/
│   │   └── app.css            # Main Tailwind CSS
│   └── js/
│       └── app.js             # Alpine.js
├── routes/
│   └── web.php                # Web routes
├── public/                     # Static assets
├── vite.config.js             # Vite configuration
├── package.json               # Node dependencies
├── composer.json              # PHP dependencies
└── .env                       # Environment variables
```

---

## 🔗 Useful Links

- [Laravel Documentation](https://laravel.com/docs)
- [Tailwind CSS Documentation](https://tailwindcss.com/docs)
- [Alpine.js Documentation](https://alpinejs.dev)
- [Vite Documentation](https://vitejs.dev)

---

**Happy building! 🚀**
