# StickyBar Plugin Structure Documentation

## Overview
This document outlines the complete file and directory structure of the StickyBar WordPress plugin. The plugin follows a modular, maintainable, and scalable architecture.

## Directory Structure

```
stickybar/
├── assets/                          # Frontend and admin assets
│   ├── css/                         # Stylesheet files
│   │   ├── stickybar-style.css     # Frontend styles
│   │   ├── stickybar-admin.css     # Admin panel styles
│   │   ├── modal-styles.css        # Modal specific styles
│   │   ├── animations.css          # Custom animations
│   │   └── responsive.css          # Responsive design styles
│   ├── js/                         # JavaScript files
│   │   ├── frontend/               # Frontend JavaScript
│   │   ├── admin/                  # Admin JavaScript
│   │   └── utils/                  # Utility JavaScript
│   ├── img/                        # Image assets
│   └── vendors/                    # Third-party libraries
│
├── includes/                        # PHP classes and core functionality
│   ├── admin/                       # Admin-specific classes
│   ├── core/                        # Core plugin classes
│   ├── frontend/                    # Frontend display classes
│   ├── database/                    # Database handling
│   ├── integrations/                # Third-party integrations
│   └── utils/                       # Utility classes
│
├── languages/                       # Internationalization files
│
├── templates/                       # Template files
│   ├── admin/                       # Admin templates
│   ├── frontend/                    # Frontend templates
│   └── email/                       # Email templates
│
├── tests/                           # Testing infrastructure
│   ├── phpunit/                     # PHP unit tests
│   ├── jest/                        # JavaScript tests
│   └── cypress/                     # E2E tests
│
├── config/                          # Configuration files
│
└── docs/                            # Documentation
    ├── api/                         # API documentation
    ├── user/                        # User documentation
    └── developer/                   # Developer documentation

## Key Components

### Assets
- CSS files for styling both frontend and admin interfaces
- JavaScript modules for functionality
- Image assets and third-party libraries

### Includes
- Core plugin classes
- Admin and frontend functionality
- Database handlers
- Integration modules
- Utility classes

### Templates
- Reusable template files for frontend display
- Admin interface templates
- Email notification templates

### Tests
- PHPUnit tests for PHP code
- Jest tests for JavaScript
- Cypress for end-to-end testing

### Documentation
- API documentation
- User guides
- Developer documentation

## File Naming Conventions
- PHP classes: class-{name}.php
- JavaScript modules: {name}.js
- CSS files: {name}.css
- Template files: {name}.php

## Coding Standards
- PHP: WordPress Coding Standards
- JavaScript: ESLint with WordPress configuration
- CSS: StyleLint with WordPress configuration

## Version Control
- Follows semantic versioning (MAJOR.MINOR.PATCH)
- Changelog maintained in CHANGELOG.md

## Build and Development
- Webpack for asset bundling
- Composer for PHP dependencies
- NPM for JavaScript dependencies
