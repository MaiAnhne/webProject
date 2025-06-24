#!/bin/bash

PORT=${1:-8000}

# Kiểm tra Docker đã cài và đang chạy chưa
if ! command -v docker &> /dev/null; then
    echo "❌ Docker chưa được cài đặt."
    exit 1
fi

if ! docker info &> /dev/null; then
    echo "❌ Docker daemon chưa chạy."
    exit 1
fi

# Giải phóng cổng nếu bị chiếm
if lsof -i :$PORT > /dev/null 2>&1; then
    echo "⚠️ Port $PORT is busy. Releasing..."
    sudo fuser -k ${PORT}/tcp
    sleep 1
fi

# Khởi động Laravel bằng docker
echo "🚀 Starting Laravel at http://localhost:$PORT ..."
docker run --rm -v "$(pwd)":/app -w /app -p $PORT:8000 laravelsail/php82-composer:latest php artisan serve --host=0.0.0.0 --port=8000