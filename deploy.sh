#!/bin/bash

echo "🚀 Starting Laravel Vue deployment..."

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Function to print colored output
print_status() {
    echo -e "${GREEN}[INFO]${NC} $1"
}

print_warning() {
    echo -e "${YELLOW}[WARNING]${NC} $1"
}

print_error() {
    echo -e "${RED}[ERROR]${NC} $1"
}

# Check if .env exists
if [ ! -f .env ]; then
    print_warning ".env file not found. Copying from .env.example"
    cp .env.example .env
    print_warning "Please update .env file with your database credentials"
fi

# Install PHP dependencies
print_status "Installing PHP dependencies..."
composer install --optimize-autoloader --no-dev --no-interaction

# Generate application key if not exists
if grep -q "APP_KEY=$" .env; then
    print_status "Generating application key..."
    php artisan key:generate --force
fi

# Install Node dependencies and build assets
print_status "Installing Node.js dependencies..."
npm ci --only=production

print_status "Building assets for production..."
npm run build

# Clear and optimize Laravel
print_status "Optimizing Laravel..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Set proper permissions
print_status "Setting permissions..."
chmod -R 755 storage bootstrap/cache
chmod -R 775 storage/logs

print_status "✅ Deployment completed successfully!"
print_warning "Don't forget to:"
print_warning "1. Update .env with correct database credentials"
print_warning "2. Run 'php artisan migrate' if needed"
print_warning "3. Point domain to public folder"

echo ""
echo "🎉 Your Laravel Vue app is ready!"
