# NativePHP Implementation Guide

This document provides detailed information about the NativePHP implementation in GP Surgery Mobile.

## What is NativePHP?

NativePHP is a framework that allows you to build native desktop and mobile applications using PHP and Laravel. It provides a way to create cross-platform applications (Windows, macOS, Linux, iOS, and Android) from a single Laravel codebase.

## Installation

The NativePHP package has already been installed in this project. To verify the installation:

```bash
composer show nativephp/laravel
```

## Configuration

### Environment Variables

Add the following to your `.env` file:

```env
NATIVEPHP_APP_VERSION=1.0.0
NATIVEPHP_APP_ID=com.gpsurgery.mobile
NATIVEPHP_APP_DESCRIPTION="GP Surgery mobile application"
NATIVEPHP_APP_WEBSITE=https://gpsurgery.app
```

### Configuration File

The NativePHP configuration is located at `config/nativephp.php`. Key settings include:

- **app_id**: Unique identifier for your application (reverse domain notation)
- **version**: Current version of your application
- **provider**: The service provider that bootstraps your native app
- **queue_workers**: Background workers for processing jobs
- **updater**: Configuration for automatic app updates

## Service Provider

The `NativeAppServiceProvider` is located at `app/Providers/NativeAppServiceProvider.php`. This provider:

1. **Configures the main window**: Sets the title, dimensions, and behavior
2. **Implements ProvidesPhpIni**: Allows customization of PHP settings
3. **Bootstraps the application**: Called when the native app starts

Example customization:

```php
public function boot(): void
{
    Window::open()
        ->title('GP Surgery Mobile')
        ->width(800)
        ->height(600)
        ->minWidth(600)
        ->minHeight(400)
        ->rememberState(); // Remember window size/position
}
```

## Available Commands

NativePHP provides several artisan commands:

```bash
# Database commands
php artisan native:migrate        # Run migrations
php artisan native:migrate:fresh  # Fresh migration
php artisan native:seed          # Seed database
php artisan native:db:wipe       # Wipe database

# Debug command
php artisan native:debug         # Generate debug information
```

## Building Your Application

### Development

Run the application in development mode:

```bash
php artisan serve
```

### Building for Production

NativePHP uses different builders for different platforms:

#### Desktop Applications

```bash
# For the current platform
php artisan native:build

# For specific platforms
php artisan native:build --platform=windows
php artisan native:build --platform=mac
php artisan native:build --platform=linux
```

#### Mobile Applications

```bash
# iOS
php artisan native:build ios

# Android
php artisan native:build android
```

## Features

### Window Management

```php
use Native\Laravel\Facades\Window;

// Open a new window
Window::open('window-id')
    ->title('My Window')
    ->width(800)
    ->height(600);

// Close a window
Window::close('window-id');
```

### Notifications

```php
use Native\Laravel\Facades\Notification;

Notification::title('Hello')
    ->message('This is a notification')
    ->show();
```

### Menu Bar

```php
use Native\Laravel\Facades\MenuBar;

MenuBar::create()
    ->label('My App')
    ->icon(storage_path('app/icon.png'))
    ->show();
```

### Global Shortcuts

```php
use Native\Laravel\Facades\GlobalShortcut;

GlobalShortcut::key('CmdOrCtrl+Shift+X')
    ->event(MyShortcutEvent::class)
    ->register();
```

### System Tray

```php
use Native\Laravel\Facades\SystemTray;

SystemTray::create()
    ->label('My App')
    ->icon(storage_path('app/icon.png'))
    ->show();
```

## Queue Workers

NativePHP automatically starts queue workers when your app launches. Configure them in `config/nativephp.php`:

```php
'queue_workers' => [
    'default' => [
        'queues' => ['default'],
        'memory_limit' => 128,
        'timeout' => 60,
        'sleep' => 3,
    ],
],
```

## Updates

NativePHP supports automatic updates via GitHub, S3, or DigitalOcean Spaces. Configure the updater in `config/nativephp.php`:

```php
'updater' => [
    'enabled' => env('NATIVEPHP_UPDATER_ENABLED', true),
    'default' => env('NATIVEPHP_UPDATER_PROVIDER', 'github'),
    // ... provider configuration
],
```

## Best Practices

1. **Version Management**: Always increment `NATIVEPHP_APP_VERSION` when releasing updates
2. **Window State**: Use `rememberState()` to persist window size and position
3. **Queue Workers**: Utilize background workers for long-running tasks
4. **Error Handling**: Implement proper error handling for native features
5. **Testing**: Test on all target platforms before release

## Resources

- [NativePHP Documentation](https://nativephp.com/docs)
- [NativePHP GitHub](https://github.com/NativePHP/laravel)
- [Laravel Documentation](https://laravel.com/docs)

## Troubleshooting

### Build Issues

If you encounter build issues:

```bash
# Clear caches
php artisan config:clear
php artisan cache:clear

# Generate debug info
php artisan native:debug
```

### Database Issues

If migrations fail:

```bash
php artisan native:migrate:fresh
```

### Permission Issues

Ensure your app has the necessary permissions for file system access, notifications, etc.

## Support

For issues specific to GP Surgery Mobile, open an issue on GitHub.
For NativePHP issues, consult the [official documentation](https://nativephp.com/docs).
