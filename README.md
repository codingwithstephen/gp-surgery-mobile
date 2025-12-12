# GP Surgery Mobile

A mobile application for GP Surgery built with Laravel + NativePHP for iOS and Android.

## Features

- 🚀 **NativePHP Integration** - Build native mobile apps with Laravel
- 📱 **Cross-Platform** - Deploy to iOS and Android from a single codebase
- 🔐 **User Authentication** - Secure login and registration with Laravel Sanctum
- 👥 **Patient Management** - Complete CRUD operations for patient records
- 👨‍⚕️ **Doctor Management** - Manage doctor profiles and specializations
- 📅 **Appointment Scheduling** - Book and manage patient appointments
- 📋 **Medical Records** - Track diagnoses, treatments, and prescriptions
- 🔒 **API Security** - Token-based authentication with Laravel Sanctum
- 💾 **SQLite Database** - Lightweight and portable data storage
- 📧 **Email Notifications** - Built-in email support
- ✅ **Comprehensive Tests** - Full test coverage for API endpoints

## Requirements

- PHP 8.2+
- Composer
- Node.js & NPM
- SQLite (for development)

## Installation

1. **Clone the repository**
```bash
git clone https://github.com/codingwithstephen/gp-surgery-mobile.git
cd gp-surgery-mobile
```

2. **Install dependencies**
```bash
composer install
npm install
```

3. **Configure environment**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Update .env with your credentials**
```env
APP_NAME="GP Surgery Mobile"
NATIVEPHP_APP_VERSION=1.0.0
NATIVEPHP_APP_ID=com.gpsurgery.mobile
```

5. **Run migrations and seed database**
```bash
php artisan migrate --seed
```

6. **Start development server**
```bash
php artisan serve
```

## API Documentation

The application provides a RESTful API for managing GP Surgery operations. See [API_DOCUMENTATION.md](API_DOCUMENTATION.md) for detailed endpoint documentation.

### Quick Start

1. Register a user:
```bash
curl -X POST http://localhost:8000/api/register \
  -H "Content-Type: application/json" \
  -d '{"name":"Admin","email":"admin@example.com","password":"password","password_confirmation":"password"}'
```

2. Login to get access token:
```bash
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{"email":"admin@example.com","password":"password"}'
```

3. Access protected endpoints with the token:
```bash
curl -X GET http://localhost:8000/api/patients \
  -H "Authorization: Bearer YOUR_TOKEN"
```

### Default Test Data

After running `php artisan db:seed`, the database will be populated with:
- 3 doctors (General Practice and Pediatrics)
- 3 patients with medical histories
- 3 scheduled appointments
- 1 admin user (email: admin@gpsurgery.com)

## Building for Mobile

### iOS

```bash
php artisan native:build ios
```

### Android

```bash
php artisan native:build android
```

### Configuration

Configure NativePHP settings in `config/nativephp.php`:

```php
'app_id' => env('NATIVEPHP_APP_ID', 'com.gpsurgery.mobile'),
'version' => env('NATIVEPHP_APP_VERSION', '1.0.0'),
```

## Development

### Run locally
```bash
php artisan serve
```

### Run tests
```bash
php artisan test
```

### Build assets
```bash
npm run build
```

## NativePHP

This application uses [NativePHP](https://nativephp.com/) to build native mobile applications from Laravel code. NativePHP allows you to:

- Build native iOS and Android apps
- Use familiar Laravel patterns and tools
- Access native device features
- Deploy cross-platform from a single codebase

## Deployment

1. Configure production environment variables
2. Run migrations: `php artisan migrate --force`
3. Build mobile apps: `php artisan native:build`
4. Deploy using NativePHP distribution methods

## License

This project is open-sourced software.

## Support

For support, please open an issue on GitHub.
