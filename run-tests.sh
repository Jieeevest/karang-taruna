#!/bin/bash

# Quick Start Script untuk Playwright Testing
# Karang Taruna Application

echo "🚀 Starting Karang Taruna Test Environment"
echo "=========================================="

# Check if application is running
echo ""
echo "📝 Step 1: Checking if Laravel is running..."
if curl -s http://localhost:8000 > /dev/null; then
    echo "✅ Laravel is running on http://localhost:8000"
else
    echo "❌ Laravel is not running!"
    echo "Please start Laravel in another terminal:"
    echo "  cd /Users/bitmind/Documents/SUPER-PROJECT/karang-taruna"
    echo "  php artisan serve"
    exit 1
fi

# Seed test users
echo ""
echo "📝 Step 2: Seeding test users..."
php artisan db:seed --class=UserSeeder --force
echo "✅ Test users seeded"

# Show test users
echo ""
echo "👥 Test Users Available:"
echo "  Ketua:      ketua@karangtaruna.test / password"
echo "  Admin Data: admin@karangtaruna.test / password"
echo "  Anggota:    anggota@karangtaruna.test / password"

# Run tests
echo ""
echo "📝 Step 3: Running Playwright tests..."
echo ""
npm run test:e2e

# Show results
echo ""
echo "=========================================="
echo "✅ Test execution completed!"
echo ""
echo "📊 To view detailed report:"
echo "  npm run test:report"
echo ""
