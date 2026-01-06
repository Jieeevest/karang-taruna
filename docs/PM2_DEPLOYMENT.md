# PM2 Deployment Guide

Panduan untuk menjalankan aplikasi Karang Taruna di production server menggunakan PM2.

## 📋 Prerequisites

1. **Server Requirements**

    - Node.js dan npm terinstall
    - PM2 terinstall secara global
    - PHP 7.3+ dengan ekstensi yang diperlukan
    - Composer terinstall
    - Nginx/Apache untuk web server
    - MySQL/PostgreSQL untuk database

2. **Install PM2**
    ```bash
    npm install -g pm2
    ```

## 🚀 Deployment Steps

### 1. Setup Aplikasi

```bash
# Clone repository
git clone <repository-url>
cd karang-taruna

# Install dependencies
composer install --optimize-autoloader --no-dev
npm install --production

# Setup environment
cp .env.example .env
php artisan key:generate

# Setup database
php artisan migrate --force
php artisan db:seed --force

# Build assets
npm run build

# Setup permissions
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### 2. Konfigurasi Environment (.env)

Pastikan konfigurasi `.env` untuk production:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain.com

# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=karang_taruna
DB_USERNAME=your_username
DB_PASSWORD=your_password

# Queue
QUEUE_CONNECTION=database

# Cache & Session
CACHE_DRIVER=file
SESSION_DRIVER=file
```

### 3. Jalankan dengan PM2

```bash
# Start semua proses
pm2 start ecosystem.config.js

# Atau start individual
pm2 start ecosystem.config.js --only karang-taruna-queue
pm2 start ecosystem.config.js --only karang-taruna-scheduler
```

### 4. PM2 Management Commands

```bash
# Lihat status
pm2 status

# Lihat logs
pm2 logs

# Lihat logs untuk proses tertentu
pm2 logs karang-taruna-queue
pm2 logs karang-taruna-scheduler

# Restart proses
pm2 restart karang-taruna-queue
pm2 restart karang-taruna-scheduler

# Stop proses
pm2 stop karang-taruna-queue
pm2 stop karang-taruna-scheduler

# Reload (zero-downtime restart)
pm2 reload ecosystem.config.js

# Delete proses
pm2 delete karang-taruna-queue
pm2 delete karang-taruna-scheduler
```

### 5. Setup PM2 Auto-Start

```bash
# Generate startup script
pm2 startup

# Save current process list
pm2 save
```

## 📊 Monitoring

### PM2 Monitoring

```bash
# Real-time monitoring
pm2 monit

# Web-based monitoring (pm2 plus)
pm2 plus
```

### Log Files

Logs disimpan di:

-   Queue Worker: `storage/logs/pm2-queue-error.log` & `storage/logs/pm2-queue-out.log`
-   Scheduler: `storage/logs/pm2-scheduler-error.log` & `storage/logs/pm2-scheduler-out.log`
-   Laravel Logs: `storage/logs/laravel.log`

```bash
# Tail logs
pm2 logs --lines 100

# Flush logs
pm2 flush
```

## 🔄 Deployment Updates

Ketika melakukan update aplikasi:

```bash
# Pull latest code
git pull origin main

# Update dependencies
composer install --optimize-autoloader --no-dev
npm install --production

# Run migrations
php artisan migrate --force

# Clear caches
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Build assets
npm run build

# Reload PM2 processes
pm2 reload ecosystem.config.js
```

## ⚙️ Konfigurasi Ecosystem File

File `ecosystem.config.js` berisi konfigurasi untuk:

### 1. Queue Worker (`karang-taruna-queue`)

-   Memproses background jobs
-   Auto-restart jika crash
-   Max memory: 512MB
-   Retry maksimal: 3 kali

### 2. Scheduler (`karang-taruna-scheduler`)

-   Menjalankan Laravel scheduled tasks
-   Auto-restart jika crash
-   Max memory: 256MB

## 🔧 Troubleshooting

### Queue Worker Stuck

```bash
# Restart queue worker
pm2 restart karang-taruna-queue

# Clear failed jobs
php artisan queue:flush
```

### Memory Issues

```bash
# Lihat memory usage
pm2 status

# Adjust max_memory_restart di ecosystem.config.js
# Lalu reload
pm2 reload ecosystem.config.js
```

### Permission Issues

```bash
# Fix storage permissions
sudo chown -R www-data:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache
```

## 📝 Best Practices

1. **Monitoring**: Selalu monitor logs dan resource usage
2. **Backup**: Setup automated database backups
3. **Security**:
    - Set `APP_DEBUG=false` di production
    - Gunakan HTTPS
    - Secure `.env` file permissions (chmod 600)
4. **Performance**:
    - Enable OPcache untuk PHP
    - Gunakan Redis untuk cache (opsional)
    - Optimize composer autoload: `composer dump-autoload --optimize`

## 🌐 Web Server Configuration

### Nginx Configuration Example

```nginx
server {
    listen 80;
    server_name your-domain.com;
    root /path/to/karang-taruna/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.0-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

## 📞 Support

Untuk issues atau pertanyaan, silakan hubungi tim development.
