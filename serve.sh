#!/bin/bash

PORT=${1:-8000}

if ! command -v docker &> /dev/null; then
    echo "❌ Docker chưa được cài đặt."
    exit 1
fi

if ! docker info &> /dev/null; then
    echo "❌ Docker daemon chưa chạy."
    exit 1
fi

if lsof -i :$PORT > /dev/null 2>&1; then
    echo "⚠️ Port $PORT is busy. Releasing..."
    sudo fuser -k ${PORT}/tcp
    sleep 1
fi

# Cài vendor nếu chưa có
if [ ! -d "vendor" ]; then
    echo "🔧 Đang cài đặt composer vendor..."
    docker run --rm -v "$(pwd)":/app -w /app composer install
fi

# Kiểm tra file artisan
if [ ! -f "artisan" ]; then
    echo "❌ Không tìm thấy file artisan. Bạn có chắc đây là thư mục Laravel?"
    exit 1
fi

echo "🚀 Starting Laravel at http://localhost:$PORT ..."
docker run --rm -v "$(pwd)":/app -w /app -p $PORT:8000 php:8.2-cli php artisan serve --host=0.0.0.0 --port=8000