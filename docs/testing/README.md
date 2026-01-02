# Testing Documentation

Dokumen ini berisi panduan lengkap untuk menjalankan testing pada aplikasi Karang Taruna.

## 📋 Daftar Isi

-   [Automated Testing dengan Playwright](#automated-testing-dengan-playwright)
-   [Black Box Testing Manual](#black-box-testing-manual)
-   [Setup Environment](#setup-environment)
-   [Troubleshooting](#troubleshooting)

---

## 🤖 Automated Testing dengan Playwright

### Installation

1. **Install Playwright:**

    ```bash
    npm install -D @playwright/test
    ```

2. **Install Browsers:**
    ```bash
    npx playwright install
    ```

### Running Tests

#### Menjalankan Semua Test

```bash
npm run test:e2e
```

#### Menjalankan Test Spesifik

```bash
# Test Authentication saja
npm run test:auth

# Test CMS Dashboard saja
npm run test:cms
```

#### Mode Development

```bash
# Jalankan dengan UI Mode (recommended untuk debugging)
npm run test:e2e:ui

# Jalankan dengan browser visible (headed mode)
npm run test:e2e:headed
```

#### Generate Report

```bash
# Generate dan buka HTML report
npm run test:report
```

### Test Structure

```
tests/e2e/
├── auth/
│   └── login.spec.js         # Test cases untuk login/logout
├── cms/
│   └── dashboard.spec.js     # Test cases untuk CMS dashboard
└── helpers/
    └── auth.js               # Helper functions untuk authentication
```

### Test Cases yang Tersedia

#### Authentication Module (10 test cases)

-   ✅ TC-AUTH-001: Login dengan kredensial valid
-   ✅ TC-AUTH-002: Login dengan email invalid
-   ✅ TC-AUTH-003: Login dengan password invalid
-   ✅ TC-AUTH-004: Validasi email field
-   ✅ TC-AUTH-005: Validasi password field
-   ✅ TC-AUTH-006: Remember me functionality
-   ✅ TC-AUTH-007: Logout functionality
-   ✅ TC-AUTH-008: Redirect setelah login
-   ✅ TC-AUTH-009: Redirect untuk akses unauthorized
-   ✅ TC-AUTH-010: UI elements login page

#### CMS Dashboard Module (12 test cases)

-   ✅ TC-CMS-001: Akses dashboard untuk user authenticated
-   ✅ TC-CMS-002: Tampilan statistik dashboard
-   ✅ TC-CMS-003: Welcome message dengan nama dan role
-   ✅ TC-CMS-004: Section kegiatan terbaru
-   ✅ TC-CMS-005: Section konten terbaru
-   ✅ TC-CMS-006: Layout dan UI elements
-   ✅ TC-CMS-007: Role-based access control (Ketua, Admin, Anggota)
-   ✅ TC-CMS-008: Pencegahan unauthorized access
-   ✅ TC-CMS-009: Icons dan visual elements
-   ✅ TC-CMS-010: Responsiveness

---

## 📝 Black Box Testing Manual

Untuk testing manual yang komprehensif, lihat dokumen lengkap:

**📄 [Black Box Testing Documentation](./black-box-testing.md)**

Dokumen tersebut berisi:

-   Test scenarios lengkap
-   Detailed test cases dengan expected results
-   Test execution procedures
-   Test results template
-   Defect tracking

### Quick Start Manual Testing

1. **Persiapan:**

    - Pastikan aplikasi berjalan: `php artisan serve`
    - Seed test users: `php artisan db:seed --class=UserSeeder`
    - Buka browser dan clear cache/cookies

2. **Test Users:**

    ```
    Ketua:
      Email: ketua@karangtaruna.test
      Password: password

    Admin Data:
      Email: admin@karangtaruna.test
      Password: password

    Anggota:
      Email: anggota@karangtaruna.test
      Password: password
    ```

3. **Execution:**
    - Ikuti test cases di dokumen black-box-testing.md
    - Catat hasil di kolom "Actual Results"
    - Screenshot untuk setiap failure
    - Update status (Pass/Fail)

---

## ⚙️ Setup Environment

### Prerequisites

-   Node.js v16+
-   PHP 8.0+
-   Composer
-   MySQL 8.0+

### Step-by-Step Setup

1. **Clone dan Install Dependencies:**

    ```bash
    cd /Users/bitmind/Documents/SUPER-PROJECT/karang-taruna
    composer install
    npm install
    ```

2. **Setup Environment:**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

3. **Database Setup:**

    ```bash
    # Edit .env dengan database credentials
    php artisan migrate
    php artisan db:seed
    ```

4. **Install Playwright:**

    ```bash
    npx playwright install
    ```

5. **Start Application:**

    ```bash
    # Terminal 1: Start Laravel
    php artisan serve

    # Terminal 2: Run tests
    npm run test:e2e
    ```

### Automated Server Start (Optional)

Uncomment di `playwright.config.js`:

```javascript
webServer: {
  command: 'php artisan serve',
  url: 'http://localhost:8000',
  reuseExistingServer: !process.env.CI,
  timeout: 120 * 1000,
},
```

---

## 🐛 Troubleshooting

### Issue: Test gagal karena aplikasi tidak running

**Solution:**

```bash
# Start Laravel server di terminal terpisah
php artisan serve
```

### Issue: Test users tidak ada di database

**Solution:**

```bash
# Seed database dengan test users
php artisan db:seed --class=UserSeeder

# Atau reset database
php artisan migrate:fresh --seed
```

### Issue: Playwright browsers belum terinstall

**Solution:**

```bash
npx playwright install
```

### Issue: Test timeout

**Solution:**

-   Pastikan aplikasi berjalan di http://localhost:8000
-   Check `playwright.config.js` untuk baseURL
-   Increase timeout di config jika perlu

### Issue: Test inconsistent/flaky

**Solution:**

```bash
# Jalankan test dengan retries
npx playwright test --retries=2

# Atau debug dengan UI mode
npm run test:e2e:ui
```

### Issue: Screenshot/video tidak tersimpan

**Solution:**

-   Check folder `test-results/` dan `playwright-report/`
-   Pastikan config memiliki:
    ```javascript
    screenshot: 'only-on-failure',
    video: 'retain-on-failure',
    ```

---

## 📊 Test Reports

### HTML Report

Setelah running test, buka report:

```bash
npm run test:report
```

Report includes:

-   ✅ Test results summary
-   📸 Screenshots
-   🎥 Videos (for failures)
-   📝 Test logs
-   ⏱️ Execution time

### JSON Report

Results juga tersimpan di:

```
test-results/results.json
```

---

## 🔧 Configuration

### Playwright Config

File: `playwright.config.js`

Key settings:

-   `baseURL`: http://localhost:8000
-   `testDir`: ./tests/e2e
-   `timeout`: 30000ms
-   `retries`: 0 (2 on CI)

### Browser Matrix

Tests run on:

-   ✅ Chromium (Chrome/Edge)
-   ✅ Firefox
-   ✅ WebKit (Safari)

---

## 📚 Additional Resources

-   [Playwright Documentation](https://playwright.dev)
-   [Laravel Testing Guide](https://laravel.com/docs/testing)
-   [Black Box Testing Best Practices](https://www.softwaretestinghelp.com/black-box-testing/)

---

## 💡 Best Practices

1. **Selalu run test sebelum commit**
2. **Update test cases saat ada perubahan fitur**
3. **Document failures dengan screenshot**
4. **Keep test data clean dan consistent**
5. **Run full test suite sebelum deployment**

---

## 📞 Support

Jika ada pertanyaan atau issue, hubungi:

-   QA Team Lead: [Name]
-   Email: [Email]

---

**Last Updated:** January 2, 2026
