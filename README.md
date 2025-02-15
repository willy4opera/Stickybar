# Stickybar WordPress Plugin

## Overview
Stickybar is a WordPress plugin that implements a customizable sticky navigation bar for enhanced website navigation and user experience.

## Project Structure
```
stickybar/
├── assets/                      # Frontend and admin assets
│   ├── css/                     # Stylesheet files
│   │   ├── animations.css
│   │   ├── modal-styles.css
│   │   ├── responsive.css
│   │   ├── stickybar-admin.css
│   │   └── stickybar-style.css
│   ├── img/                     # Image assets
│   │   ├── backgrounds/
│   │   ├── icons/
│   │   └── placeholders/
│   ├── js/                      # JavaScript files
│   │   ├── admin/
│   │   ├── frontend/
│   │   └── utils/
│   └── vendors/                 # Third-party libraries
│       ├── chart.js/
│       ├── colorpicker/
│       ├── datepicker/
│       └── select2/
├── config/                      # Configuration files
│   ├── environments/
│   ├── phpunit.xml
│   └── webpack.config.js
├── docs/                        # Documentation
│   ├── api/
│   ├── developer/
│   ├── user/
│   ├── CHANGELOG.md
│   ├── CONTRIBUTING.md
│   └── ROADMAP.md
├── includes/                    # Core PHP classes
│   ├── admin/                   # Admin functionality
│   │   ├── class-analytics-dashboard.php
│   │   ├── class-stickybar-admin.php
│   │   ├── class-stickybar-settings.php
│   │   └── class-template-manager.php
│   ├── core/                    # Core functionality
│   │   ├── class-stickybar-activator.php
│   │   ├── class-stickybar-deactivator.php
│   │   ├── class-stickybar-i18n.php
│   │   ├── class-stickybar-loader.php
│   │   └── class-stickybar-updater.php
│   ├── database/                # Database operations
│   │   ├── class-analytics-db.php
│   │   ├── class-stickybar-db.php
│   │   └── migrations/
│   ├── frontend/               # Frontend functionality
│   │   ├── class-display-rules.php
│   │   ├── class-modal-generator.php
│   │   ├── class-stickybar-frontend.php
│   │   └── class-stickybar-shortcode.php
│   ├── integrations/           # Third-party integrations
│   │   ├── analytics/
│   │   ├── crm/
│   │   └── whatsapp/
│   └── utils/                  # Utility classes
│       ├── class-cache-handler.php
│       ├── class-security.php
│       ├── class-stickybar-helper.php
│       └── class-stickybar-logger.php
├── languages/                  # Translation files
│   ├── stickybar-en_US.po
│   ├── stickybar-es_ES.po
│   └── stickybar.pot
├── templates/                  # Template files
│   ├── admin/
│   │   ├── dashboard/
│   │   └── settings/
│   ├── email/
│   │   ├── notification.php
│   │   └── reports.php
│   └── frontend/
│       ├── modals/
│       └── sticky-bar/
└── tests/                      # Testing suites
    ├── cypress/               # E2E tests
    ├── jest/                  # JavaScript tests
    └── phpunit/              # PHP unit tests
```

## Installation
1. Download the plugin files
2. Upload to wp-content/plugins directory
3. Activate the plugin through WordPress admin panel
4. Configure settings in the Stickybar menu

## Development Setup
### Prerequisites
- PHP 7.4 or higher
- WordPress 5.0 or higher
- Node.js and npm for asset compilation
- Composer for PHP dependencies

### Local Development
1. Clone the repository
2. Install dependencies:
```bash
composer install
npm install
```

3. Build assets:
```bash
npm run build
```

## Testing
The plugin includes comprehensive testing suites:
- PHPUnit for PHP unit tests
- Jest for JavaScript testing
- Cypress for E2E testing

Run tests:
```bash
# PHP tests
./vendor/bin/phpunit -c config/phpunit.xml

# JavaScript tests
npm run test

# E2E tests
npm run test:e2e
```

## Documentation
- API documentation: /docs/api/
- Developer guides: /docs/developer/
- User documentation: /docs/user/
- Changelog: /docs/CHANGELOG.md
- Contributing: /docs/developer/CONTRIBUTING.md

## Internationalization
The plugin supports multiple languages. Translation files are located in the /languages directory.
Currently supported:
- English (en_US)
- Spanish (es_ES)

## Key Files
- `stickybar.php`: Main plugin file
- `uninstall.php`: Clean-up on plugin uninstallation
- `composer.json`: PHP dependencies
- `package.json`: Node.js dependencies
- `config/webpack.config.js`: Asset bundling configuration

## Support and Contributing
- For bugs and feature requests, please create an issue
- See CONTRIBUTING.md for development guidelines
- For security issues, please contact security@example.com

## License
This project is licensed under the GPL v2 or later.
