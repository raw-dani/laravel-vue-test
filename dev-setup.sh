#!/bin/bash

echo "🛠️  Setting up development environment..."

# Copy environment file
cp .env.example .env

# Install dependencies
composer install
npm install

# Generate key
php artisan key:generate

# Create SQLite database for development
touch database/database.sqlite

# Run migrations
php artisan migrate

echo "✅ Development setup completed!"
echo "Run 'npm run dev' and 'php artisan serve' to start development"
