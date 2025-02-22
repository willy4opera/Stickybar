# Stickybar Technical Documentation

## Project Structure
```
/Stickybar
├── assets/
│   ├── css/
│   │   ├── admin.css
│   │   ├── frontend.css
│   │   └── responsive.css
│   ├── js/
│   │   ├── admin.js
│   │   ├── frontend.js
│   │   └── analytics.js
│   ├── img/
│   └── vendors/
├── includes/
│   ├── admin/
│   │   ├── class-stickybar-admin.php
│   │   ├── class-analytics-dashboard.php
│   │   └── class-settings-page.php
│   ├── core/
│   │   ├── class-stickybar-loader.php
│   │   ├── class-stickybar-i18n.php
│   │   └── class-stickybar.php
│   ├── frontend/
│   │   ├── class-stickybar-frontend.php
│   │   └── class-display-controller.php
│   └── integrations/
│       └── class-stickybar-api.php
├── languages/
│   ├── stickybar.pot
│   ├── stickybar-en_US.po
│   └── stickybar-en_US.mo
├── templates/
│   ├── admin/
│   │   └── settings-page.php
│   └── frontend/
│       ├── sticky-bar.php
│       └── modal.php
└── tests/
    ├── phpunit/
    ├── jest/
    └── cypress/
```

## Dependencies

### PHP Dependencies
```json
{
    "require": {
        "php": ">=7.4",
        "composer/installers": "~1.0"
    },
    "require-dev": {
        "phpunit/phpunit": "^9.0",
        "mockery/mockery": "^1.4",
        "php-parallel-lint/php-parallel-lint": "^1.2",
        "squizlabs/php_codesniffer": "^3.5",
        "wp-coding-standards/wpcs": "^2.3"
    }
}
```

### JavaScript Dependencies
```json
{
    "dependencies": {
        "react": "^17.0.2",
        "react-dom": "^17.0.2",
        "axios": "^0.21.1",
        "lodash": "^4.17.21"
    },
    "devDependencies": {
        "@babel/core": "^7.15.0",
        "@babel/preset-env": "^7.15.0",
        "@babel/preset-react": "^7.14.5",
        "babel-loader": "^8.2.2",
        "webpack": "^5.50.0",
        "webpack-cli": "^4.8.0",
        "jest": "^27.0.6",
        "cypress": "^8.3.0",
        "eslint": "^7.32.0"
    }
}
```

## Development Environment Setup

### Prerequisites
- PHP 7.4 or higher
- MySQL 5.7 or higher
- Node.js 14 or higher
- npm 6 or higher
- Composer 2.0 or higher
- WordPress 5.0 or higher

### Local Development Setup
1. Configure WordPress development environment:
```bash
# Install WordPress
wp core download
wp config create --dbname=stickybar_dev --dbuser=root --dbpass=root
wp core install --url=localhost:8080 --title=StickybarDev --admin_user=admin --admin_password=admin --admin_email=admin@example.com
```

2. Clone and install dependencies:
```bash
# Clone repository
git clone https://github.com/yourusername/stickybar.git wp-content/plugins/stickybar
cd wp-content/plugins/stickybar

# Install PHP dependencies
composer install

# Install JavaScript dependencies
npm install
```

3. Configure development environment:
```bash
# Set up environment variables
cp .env.example .env
# Edit .env with your local settings

# Build assets
npm run dev
```

### Development Workflow

#### Building Assets
```bash
# Development build with watch
npm run dev:watch

# Production build
npm run build
```

#### Running Tests
```bash
# PHP Unit Tests
composer test

# JavaScript Unit Tests
npm run test

# E2E Tests
npm run test:e2e

# All tests
npm run test:all
```

#### Code Linting
```bash
# PHP Linting
composer lint

# JavaScript Linting
npm run lint

# CSS Linting
npm run lint:css

# Fix linting issues
composer lint:fix
npm run lint:fix
```

### Code Standards

#### PHP
- Follow WordPress PHP Coding Standards
- PSR-4 autoloading
- PHPDoc blocks for all classes and methods
- Type hinting where possible
- Strict typing enabled

#### JavaScript
- ESLint with WordPress configuration
- JSDoc documentation
- ES6+ features
- Module-based architecture
- React components follow functional paradigm

#### CSS
- BEM methodology
- CSS custom properties for theming
- Mobile-first approach
- SCSS preprocessing
- Modular architecture

### Database Schema

#### Settings Table
```sql
CREATE TABLE `{prefix}_stickybar_settings` (
    `id` bigint(20) NOT NULL AUTO_INCREMENT,
    `setting_name` varchar(191) NOT NULL,
    `setting_value` longtext NOT NULL,
    `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
    `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    UNIQUE KEY `setting_name` (`setting_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

#### Analytics Table
```sql
CREATE TABLE `{prefix}_stickybar_analytics` (
    `id` bigint(20) NOT NULL AUTO_INCREMENT,
    `event_type` varchar(50) NOT NULL,
    `event_data` json DEFAULT NULL,
    `user_id` bigint(20) DEFAULT NULL,
    `page_url` varchar(255) DEFAULT NULL,
    `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`),
    KEY `event_type` (`event_type`),
    KEY `created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

### Performance Optimization

#### Caching Strategy
1. Object Caching
    - Transients for temporary data
    - Object cache for frequent queries
    - Page caching for static content

2. Database Optimization
    - Indexed queries
    - Prepared statements
    - Query optimization
    - Batch processing

3. Asset Management
    - Minification
    - Concatenation
    - Lazy loading
    - Critical CSS
    - Deferred JavaScript

### Security Measures

1. Input Validation
    ```php
    // Sanitization
    sanitize_text_field()
    sanitize_textarea_field()
    wp_kses_post()
    ```

2. Output Escaping
    ```php
    // Escaping
    esc_html()
    esc_attr()
    esc_url()
    wp_kses()
    ```

3. Capability Checks
    ```php
    // Permission checks
    current_user_can()
    check_admin_referer()
    wp_verify_nonce()
    ```

### Deployment Process

1. Version Control
    ```bash
    # Create release branch
    git checkout -b release/x.x.x

    # Update version numbers
    sed -i 's/Version: x.x.x/Version: NEW_VERSION/' stickybar.php
    ```

2. Build Process
    ```bash
    # Clean install dependencies
    composer install --no-dev
    npm ci

    # Build assets
    npm run build

    # Run tests
    composer test
    npm run test
    ```

3. Release Checklist
    - [ ] Update version numbers
    - [ ] Update changelog
    - [ ] Run full test suite
    - [ ] Build production assets
    - [ ] Create release tag
    - [ ] Deploy to WordPress.org

### Monitoring and Debugging

1. Error Logging
    ```php
    // Enable debugging
    define('WP_DEBUG', true);
    define('WP_DEBUG_LOG', true);
    define('WP_DEBUG_DISPLAY', false);
    ```

2. Performance Monitoring
    - New Relic integration
    - Query Monitor plugin
    - Custom logging system

3. Analytics Tracking
    - Event tracking
    - Performance metrics
    - Error reporting
    - Usage statistics

