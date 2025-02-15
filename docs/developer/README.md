# Stickybar Developer Documentation

## Project Overview
Stickybar is a WordPress plugin developed and maintained by Williams Obi. For maintainer contact information and responsibilities, please see [MAINTAINERS.md](../MAINTAINERS.md).

## Developer Contact
**Lead Developer:** Williams Obi
- Website: [williamsobi.com.ng](https://williamsobi.com.ng)
- GitHub: [github.com/willy4opera](https://git.com/willy4opera)
- Contact: +234 803 075 6350

## Architecture Overview

### Core Components
1. Frontend Layer
   - Sticky bar display management
   - User interaction handling
   - Responsive design implementation

2. Admin Layer
   - Settings management interface
   - Analytics dashboard
   - Template management

3. Core System
   - Plugin initialization
   - Hook management
   - Asset loading
   - Data management

4. Database Layer
   - Settings storage
   - Analytics data
   - Custom tables management

## Implementation Details

### Class Structure
- Main Plugin Class: `Stickybar`
  - Handles plugin initialization
  - Manages core functionality
  - Coordinates between components

- Frontend Controller: `Stickybar_Frontend`
  - Manages frontend display
  - Handles user interactions
  - Controls responsive behavior

- Admin Controller: `Stickybar_Admin`
  - Manages admin interface
  - Handles settings
  - Processes analytics

### Hook System
```php
// Action hooks
do_action('stickybar_init');
do_action('stickybar_before_display');
do_action('stickybar_after_display');

// Filter hooks
apply_filters('stickybar_content', $content);
apply_filters('stickybar_settings', $settings);
```

## Development Guidelines

### Getting Started
1. Clone the repository
2. Install dependencies
3. Set up development environment
4. Run tests
5. Start development

### Code Standards
- Follow WordPress coding standards
- Use PSR-4 autoloading
- Maintain proper documentation
- Write unit tests

### Testing
```bash
# Run PHP tests
composer test

# Run JS tests
npm test

# Run E2E tests
npm run test:e2e
```

### Build Process
```bash
# Development
npm run dev

# Production
npm run build
```

## Performance Considerations
- Implement caching strategies
- Optimize database queries
- Minimize asset loading
- Use transients effectively

## Security Measures
- Input validation
- Output escaping
- Capability checks
- Nonce verification

## Support and Updates
For technical support or feature requests, contact the lead developer:
- Email: Available on [williamsobi.com.ng](https://williamsobi.com.ng)
- GitHub Issues: [github.com/willy4opera](https://git.com/willy4opera)
- Phone: +234 803 075 6350

## License
This project is licensed under the GPL v2 or later.

