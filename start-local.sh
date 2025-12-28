#!/bin/bash

# Local development server starter
# Usage: ./start-local.sh

echo "🚀 Ziya Aytar Yapı İnşaat - Local Development Server"
echo "=================================================="
echo ""
echo "📋 Öncelikle veritabanını oluşturduğunuzdan emin olun:"
echo "   mysql -u root -p < database.sql"
echo ""
echo "🌐 Server başlatılıyor..."
echo "   http://localhost:8000 adresinde çalışacak"
echo ""
echo "⏹️  Durdurmak için Ctrl+C tuşlarına basın"
echo ""

php -S localhost:8000 router.php

