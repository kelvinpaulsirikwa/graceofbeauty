# Site Configuration Guide

## Overview
All site-wide settings are centralized in `config/site.php`. This makes it easy to update business information across the entire website from one location.

## Configuration File Location
```
config/site.php
```

## Available Configuration Options

### 1. Site Name
```php
config('site.name')  // Returns: "Akame"
```
Used in: Header, Footer, Page Titles

### 2. Site Tagline
```php
config('site.tagline')  // Returns: "Hair Salon & Spa"
```
Used in: Page Titles, Meta Descriptions

### 3. Contact Information

#### Phone Number (Full)
```php
config('site.contact.phone')  // Returns: "(+12) 345 678 910"
```
Used in: Footer

#### Phone Number (Short)
```php
config('site.contact.phone_short')  // Returns: "(+12) 345-6789"
```
Used in: Top Navigation Bar

#### Email Address
```php
config('site.contact.email')  // Returns: "Hello.colorlib@gmail.com"
```
Used in: Footer

#### Physical Address
```php
config('site.contact.address')  // Returns: "Iris Watson, P.O. Box 283 8562 Fusce Rd, NY"
```
Used in: Footer

### 4. Opening Hours

#### Weekdays (Monday - Friday)
```php
config('site.opening_hours.weekdays.label')  // Returns: "Monday - Friday"
config('site.opening_hours.weekdays.hours')  // Returns: "10.00 - 23.00"
```

#### Saturday
```php
config('site.opening_hours.saturday.label')  // Returns: "Saturday"
config('site.opening_hours.saturday.hours')  // Returns: "10.00 - 19.00"
```

#### Sunday
```php
config('site.opening_hours.sunday.label')  // Returns: "Sunday"
config('site.opening_hours.sunday.hours')  // Returns: "Closed"
```

### 5. Social Media Links

```php
config('site.social.facebook')   // Facebook profile URL
config('site.social.twitter')    // Twitter profile URL
config('site.social.google')     // Google profile URL
config('site.social.instagram')  // Instagram profile URL
config('site.social.youtube')    // YouTube channel URL
config('site.social.linkedin')   // LinkedIn profile URL
```

## How to Update Configuration

### Method 1: Edit config/site.php directly
```php
// config/site.php
'name' => 'Akame',
'contact' => [
    'phone' => '(+12) 345 678 910',
    'email' => 'Hello.colorlib@gmail.com',
    // ...
],
```

### Method 2: Use Environment Variables (.env)
Add these to your `.env` file:
```env
SITE_NAME="Akame"
SITE_TAGLINE="Hair Salon & Spa"
SITE_PHONE="(+12) 345 678 910"
SITE_PHONE_SHORT="(+12) 345-6789"
SITE_EMAIL="Hello.colorlib@gmail.com"
SITE_ADDRESS="Iris Watson, P.O. Box 283 8562 Fusce Rd, NY"

# Social Media
SOCIAL_FACEBOOK="https://facebook.com/yourpage"
SOCIAL_TWITTER="https://twitter.com/yourprofile"
SOCIAL_INSTAGRAM="https://instagram.com/yourprofile"
```

## Usage in Blade Templates

### Display Site Name
```blade
<h1>{{ config('site.name') }}</h1>
```

### Display Contact Info
```blade
<p>Call us: {{ config('site.contact.phone') }}</p>
<p>Email: {{ config('site.contact.email') }}</p>
```

### Display Opening Hours
```blade
<p>{{ config('site.opening_hours.weekdays.label') }}: {{ config('site.opening_hours.weekdays.hours') }}</p>
```

### Display Social Media Links
```blade
<a href="{{ config('site.social.facebook') }}">
    <i class="fab fa-facebook"></i>
</a>
```

## Benefits of This Configuration System

1. **Centralized Management**: Update business info in one place
2. **Easy Maintenance**: No need to search through multiple files
3. **Consistency**: Same information displayed everywhere
4. **Environment-Specific**: Different values for development/production
5. **Type Safety**: Organized structure prevents typos
6. **Version Control**: Track changes to business information

## Files Updated to Use Config

- `resources/views/websitepages/layouts/partials/topnavbar.blade.php`
- `resources/views/websitepages/layouts/partials/header.blade.php`
- `resources/views/websitepages/layouts/partials/footer.blade.php`
- `resources/views/websitepages/layouts/app.blade.php`

## After Making Changes

After updating the configuration, clear the config cache:
```bash
php artisan config:clear
```

Or cache the new configuration:
```bash
php artisan config:cache
```
