# 📚 Panduan Setup Project - Karang Taruna

Panduan lengkap untuk setup project Laravel Karang Taruna di laptop/komputer baru.

---

## 📋 Prasyarat

Pastikan sudah terinstall di laptop Anda:

-   **PHP** >= 7.3 atau 8.0+
-   **Composer** (Dependency Manager untuk PHP)
-   **Node.js & npm** (untuk frontend assets)
-   **MySQL/MariaDB** (Database)
-   **Git** (untuk clone repository)

---

## 🚀 Langkah-langkah Setup

### 1️⃣ Clone Repository

```bash
git clone <repository-url> karang-taruna
cd karang-taruna
```

### 2️⃣ Install Dependencies PHP (Composer)

```bash
composer install
```

> ℹ️ Ini akan menginstall semua package Laravel dan dependencies PHP yang dibutuhkan

### 3️⃣ Install Dependencies Frontend (NPM)

```bash
npm install
```

> ℹ️ Ini akan menginstall Tailwind CSS, Alpine.js, Flowbite, SweetAlert2, dan dependencies lainnya

### 4️⃣ Setup Environment File

Copy file `.env.example` menjadi `.env`:

```bash
cp .env.example .env
```

Lalu edit file `.env` dan sesuaikan konfigurasi database:

```env
APP_NAME="Karang Taruna"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=karang_taruna
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 5️⃣ Generate Application Key

```bash
php artisan key:generate
```

> ℹ️ Ini akan generate `APP_KEY` di file `.env`

### 6️⃣ Buat Database

Buat database baru di MySQL/MariaDB dengan nama sesuai yang ada di `.env`:

```sql
CREATE DATABASE karang_taruna;
```

Atau gunakan phpMyAdmin/MySQL Workbench untuk membuat database.

### 7️⃣ Run Migrations

Jalankan migrations untuk membuat struktur tabel:

```bash
php artisan migrate
```

### 8️⃣ Run Seeders (Optional tapi Disarankan)

Jika ada seeders untuk data awal (user default, categories, dll):

```bash
php artisan db:seed
```

Atau jika ingin refresh dan seed ulang:

```bash
php artisan migrate:fresh --seed
```

> ⚠️ **PERHATIAN**: `migrate:fresh` akan **menghapus semua data** dan create ulang tabel!

### 9️⃣ Create Storage Link

Untuk akses file upload (gambar, dokumentasi):

```bash
php artisan storage:link
```

### 🔟 Build Assets Frontend

Compile CSS dan JavaScript:

**Untuk Development:**

```bash
npm run dev
```

**Atau watch mode (auto-compile saat ada perubahan):**

```bash
npm run watch
```

**Untuk Production:**

```bash
npm run prod
```

---

## ▶️ Menjalankan Aplikasi

### Menggunakan Laravel Development Server

```bash
php artisan serve
```

Aplikasi akan berjalan di: `http://localhost:8000`

### Menjalankan dengan Watch Mode (untuk development)

Buka 2 terminal:

**Terminal 1** - Laravel Server:

```bash
php artisan serve
```

**Terminal 2** - Watch Assets:

```bash
npm run watch
```

---

## 👤 Login ke CMS

Jika sudah menjalankan seeder, biasanya ada user default:

-   **URL CMS**: `http://localhost:8000/cms/dashboard`
-   **Username/Email**: (cek di database seeder)
-   **Password**: (cek di database seeder)

---

## 🧪 Testing (Optional)

### E2E Testing dengan Playwright

Install Playwright browsers (hanya sekali):

```bash
npx playwright install
```

Run tests:

```bash
npm run test:e2e
```

Run specific tests:

```bash
npm run test:auth    # Test authentication
npm run test:cms     # Test CMS modules
```

---

## 🔧 Troubleshooting

### Error: "No application encryption key has been specified"

```bash
php artisan key:generate
```

### Error: Storage link tidak work

```bash
php artisan storage:link
```

### Error: Permission denied (folder storage/logs)

```bash
chmod -R 775 storage bootstrap/cache
```

### Error: Class not found

```bash
composer dump-autoload
```

### Assets tidak muncul/tidak update

```bash
npm run dev
# atau
npm run watch
```

### Database connection refused

-   Pastikan MySQL/MariaDB sudah running
-   Cek konfigurasi database di `.env`
-   Pastikan database sudah dibuat

---

## 📦 Struktur Project

```
karang-taruna/
├── app/
│   ├── Http/Controllers/
│   │   ├── CMS/              # CMS Controllers
│   │   └── Frontend/         # Public Controllers
│   └── Models/               # Eloquent Models
├── database/
│   ├── migrations/           # Database Schema
│   └── seeders/              # Data Seeders
├── resources/
│   ├── views/
│   │   ├── cms/              # CMS Views
│   │   ├── public/           # Public Views
│   │   └── layouts/          # Layout Templates
│   ├── css/                  # Stylesheets
│   └── js/                   # JavaScript
├── routes/
│   ├── web.php               # Web Routes
│   ├── api.php               # API Routes
│   └── auth.php              # Auth Routes
└── public/                   # Public Assets
```

---

## 🎯 Fitur Utama

### CMS Features:

-   ✅ Dashboard dengan statistik
-   ✅ Manajemen User & Roles (Ketua, Admin Data, Anggota)
-   ✅ Manajemen Categories
-   ✅ Manajemen News/Content
-   ✅ Manajemen Activity Plans (dengan approval)
-   ✅ Manajemen Activity Realizations
-   ✅ Manajemen Documentation

### Public Features:

-   ✅ Home Page
-   ✅ About (Profil Organisasi)
-   ✅ Activities (Kegiatan)
-   ✅ News (Berita)
-   ✅ Documentation (Dokumentasi)

---

## 📞 Bantuan

Jika ada masalah saat setup, cek:

1. Versi PHP: `php -v`
2. Versi Composer: `composer -V`
3. Versi Node.js: `node -v`
4. Versi NPM: `npm -v`
5. MySQL running: Cek service MySQL

---

**Selamat Coding! 🚀**
