# Laravel Vue Test Application

Simple Laravel + Vue.js application for testing cPanel hosting compatibility.

## Features

- ✅ Laravel Backend API
- ✅ Vue.js Frontend (CDN version for compatibility)
- ✅ Database Connection Test
- ✅ Server Information Display
- ✅ Reactive UI Components

## Local Development

### Prerequisites
- PHP 8.1+
- Composer
- Node.js 16+
- NPM

### Setup

1. Clone repository:
```bash
git clone https://github.com/yourusername/laravel-vue-test.git
cd laravel-vue-test
```

2. Run development setup:
```bash
chmod +x dev-setup.sh
./dev-setup.sh
```

3. Start development servers:
```bash
# Terminal 1 - Laravel
php artisan serve

# Terminal 2 - Vite
npm run dev
```

4. Open http://localhost:8000

## cPanel Deployment

### Method 1: Direct Upload

1. Build for production:
```bash
npm run build
```

2. Upload files to cPanel
3. Move `public` folder contents to `public_html`
4. Update `index.php` paths
5. Configure `.env` file

### Method 2: Git Deployment (Recommended)

1. SSH into your cPanel:
```bash
ssh username@yourdomain.com
```

2. Clone repository:
```bash
cd public_html
git clone https://github.com/raw-dani/laravel-vue-test.git .
```

3. Run deployment script:
```bash
chmod +x deploy.sh
./deploy.sh
```

4. Configure web root to point to `public` folder

### Method 3: Automated Updates

For future updates:
```bash
git pull origin main
./deploy.sh
```

## Configuration

### Database Setup

Update `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=localhost
DB_DATABASE=your_db_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password
```

### Domain Configuration

Update `.env` file:
```env
APP_URL=https://yourdomain.com
```

## Testing Features

1. **Server Info**: Displays PHP and Laravel versions
2. **Vue.js Reactivity**: Real-time input binding
3. **API Connection**: Tests Laravel API endpoints
4. **Database Connection**: Verifies database connectivity

## Troubleshooting

### Common Issues

1. **500 Error**: Check file permissions
```bash
chmod -R 755 storage bootstrap/cache
```

2. **Assets not loading**: Ensure public folder is web root

3. **Database connection failed**: Verify credentials in `.env`

4. **Vue.js not working**: Check browser console for errors

### File Structure for cPanel

```
public_html/
├── laravel-app/          # Laravel files (outside public_html)
│   ├── app/
│   ├── config/
│   ├── routes/
│   └── ...
├── index.php             # Updated Laravel entry point
├── css/                  # Built assets
├── js/                   # Built assets
└── .htaccess            # URL rewriting
```

## Support

This is a testing application to verify cPanel hosting compatibility with:
- PHP 8.1+
- Laravel 10+
- Vue.js 3+
- MySQL databases
- URL rewriting
- File permissions

## License

Open source - feel free to modify for your testing needs.
```

## Step 6: Update composer.json untuk production

```json:composer.json
{
    "name": "laravel/laravel",
    "type": "project",
    "description": "Laravel Vue Test Application",
    "keywords": ["framework", "laravel", "vue"],
    "license": "MIT",
    "require": {
        "php": "^8.1",
        "guzzlehttp/guzzle": "^7.2",
        "laravel/framework": "^10.10",
        "laravel/sanctum": "^3.2",
        "laravel/tinker": "^2.8"
    },
    "require-dev": {
        "fakerphp/faker": "^1.9.1",
        "laravel/pint": "^1.0",
        "laravel/sail": "^1.18",
        "mockery/mockery": "^1.4.4",
        "nunomaduro/collision": "^7.0",
        "phpunit/phpunit": "^10.1",
        "spatie/laravel-ignition": "^2.0"
    },
    "autoload": {
        "psr-4": {
            "App\\": "app/",
            "Database\\Factories\\": "database/factories/",
            "Database\\Seeders\\": "database/seeders/"
        }
    },
    "autoload-dev": {
        "psr-4": {
            "Tests\\": "tests/"
        }
    },
    "scripts": {
        "post-autoload-dump": [
            "Illuminate\\Foundation\\ComposerScripts::postAutoloadDump",
            "@php artisan package:discover --ansi"
        ],
        "post-update-cmd": [
            "@php artisan vendor:publish --tag=laravel-assets --ansi --force"
        ],
        "post-root-package-install": [
            "@php -r \"file_exists('.env') || copy('.env.example', '.env');\""
        ],
        "post-create-project-cmd": [
            "@php artisan key:generate --ansi"
        ],
        "deploy": [
            "composer install --optimize-autoloader --no-dev",
            "php artisan config:cache",
            "php artisan route:cache",
            "php artisan view:cache"
        ]
    },
    "extra": {
        "laravel": {
            "dont-discover": []
        }
    },
    "config": {
        "optimize-autoloader": true,
        "preferred-install": "dist",
        "sort-packages": true,
        "allow-plugins": {
            "pestphp/pest-plugin": true,
            "php-http/discovery": true
        }
    },
    "minimum-stability": "stable",
    "prefer-stable": true
}
```

## Step 7: Commit dan push ke Git

```bash
git init
```

```bash
git add .
```

```bash
git commit -m "Initial commit: Laravel Vue test application"
```

```bash
git branch -M main
```

```bash
git remote add origin https://github.com/raw-dani/laravel-vue-test.git
```

```bash
git push -u origin main
```

## Step 8: Deploy ke cPanel via SSH

Setelah di cPanel:

```bash
ssh username@yourdomain.com
```

```bash
cd public_html
```

```bash
git clone https://github.com/raw-dani/laravel-vue-test.git .
```

```bash
chmod +x deploy.sh
```

```bash
./deploy.sh
```

## Step 9: Update otomatis di masa depan

```bash
git pull origin main && ./deploy.sh
