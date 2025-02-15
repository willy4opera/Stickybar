# Stickybar API Documentation

## API Maintainer
**Williams Obi**
- Website: [williamsobi.com.ng](https://williamsobi.com.ng)
- GitHub: [github.com/willy4opera](https://git.com/willy4opera)
- Contact: +234 803 075 6350

## API Overview
The Stickybar plugin provides a comprehensive API for customizing and extending its functionality.

## WordPress Actions

### `stickybar_init`
Fired when the Stickybar plugin initializes.
```php
do_action('stickybar_init');
```

### `stickybar_before_display`
Fired before the sticky bar is displayed.
```php
do_action('stickybar_before_display');
```

### `stickybar_after_display`
Fired after the sticky bar is displayed.
```php
do_action('stickybar_after_display');
```

## WordPress Filters

### `stickybar_content`
Filter the sticky bar content before display.
```php
apply_filters('stickybar_content', $content);
```

### `stickybar_settings`
Filter the sticky bar settings.
```php
apply_filters('stickybar_settings', $settings);
```

## REST API Endpoints

### Get Sticky Bar Status
```
GET /wp-json/stickybar/v1/status
```

### Update Sticky Bar Settings
```
POST /wp-json/stickybar/v1/settings
```

### Get Analytics Data
```
GET /wp-json/stickybar/v1/analytics
```

## JavaScript API

### Initialize Sticky Bar
```javascript
StickyBar.init({
    position: 'top',
    theme: 'dark',
    animation: 'slide'
});
```

### Update Content
```javascript
StickyBar.updateContent({
    text: 'New content',
    html: '<div>Custom HTML</div>'
});
```

### Event Listeners
```javascript
StickyBar.on('show', function() {
    // Handle show event
});

StickyBar.on('hide', function() {
    // Handle hide event
});
```

## API Support and Issues
For API-related questions or issues:
1. Check the documentation thoroughly
2. Search existing GitHub issues
3. Contact the maintainer:
   - Through GitHub: [github.com/willy4opera](https://git.com/willy4opera)
   - Website: [williamsobi.com.ng](https://williamsobi.com.ng)
   - Phone: +234 803 075 6350

## Error Handling
All API endpoints return standard HTTP status codes:
- 200: Success
- 400: Bad Request
- 401: Unauthorized
- 403: Forbidden
- 404: Not Found
- 500: Server Error

## Rate Limiting
API requests are limited to:
- 1000 requests per hour for authenticated users
- 100 requests per hour for unauthenticated users

## Security
- All endpoints require nonce verification
- API keys are required for authenticated endpoints
- SSL is required for all API communications

## Versioning
The API follows semantic versioning (MAJOR.MINOR.PATCH):
- MAJOR version for incompatible changes
- MINOR version for backward-compatible features
- PATCH version for backward-compatible fixes

## Deprecation Policy
- APIs are versioned
- Deprecated features are announced 6 months in advance
- Backward compatibility maintained for 12 months
- Emergency security updates may bypass this policy

## Need Help?
Contact the lead developer, Williams Obi:
- Website: [williamsobi.com.ng](https://williamsobi.com.ng)
- GitHub: [github.com/willy4opera](https://git.com/willy4opera)
- Phone: +234 803 075 6350

