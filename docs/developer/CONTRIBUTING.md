# Contributing to Stickybar

## Project Lead
This project is maintained by:

**Williams Obi**
- Website: [williamsobi.com.ng](https://williamsobi.com.ng)
- GitHub: [github.com/willy4opera](https://git.com/willy4opera)
- Contact: +234 803 075 6350

## How to Contribute

### Prerequisites
- WordPress development environment
- PHP 7.4 or higher
- Node.js and npm
- Composer
- Git

### Development Workflow
1. Fork the repository
2. Create a feature branch
```bash
git checkout -b feature/your-feature-name
```
3. Make your changes
4. Run tests
5. Submit a pull request

### Code Standards
- Follow WordPress PHP Coding Standards
- Use JSDoc for JavaScript documentation
- Write meaningful commit messages
- Include unit tests for new features

### Commit Guidelines
```
type(scope): subject

body

footer
```

Types:
- feat: New feature
- fix: Bug fix
- docs: Documentation
- style: Formatting
- refactor: Code restructuring
- test: Tests
- chore: Maintenance

### Testing
Before submitting a PR:
1. Run unit tests
```bash
composer test
npm test
```
2. Run linting
```bash
composer lint
npm run lint
```
3. Test in different WordPress versions

### Pull Request Process
1. Update documentation
2. Add tests for new features
3. Ensure all tests pass
4. Update changelog
5. Request review from maintainer

### Review Process
- PRs will be reviewed by Williams Obi
- Feedback will be provided within 2-3 business days
- Changes may be requested
- Once approved, PR will be merged

## Getting Help
If you need assistance:
1. Check existing documentation
2. Search GitHub issues
3. Contact the maintainer:
   - Through GitHub: [github.com/willy4opera](https://git.com/willy4opera)
   - Website: [williamsobi.com.ng](https://williamsobi.com.ng)
   - Phone: +234 803 075 6350

## Development Resources
- [WordPress Plugin Handbook](https://developer.wordpress.org/plugins/)
- [WordPress Coding Standards](https://developer.wordpress.org/coding-standards/)
- [Project Documentation](./README.md)
- [Technical Documentation](./TECHNICAL.md)

## Community Guidelines
- Be respectful and inclusive
- Provide constructive feedback
- Help other contributors
- Follow the code of conduct

## Project Structure
```
/Stickybar
├── assets/
├── includes/
├── templates/
├── tests/
└── docs/
```

## Release Process
1. Version bump
2. Update changelog
3. Run test suite
4. Create release PR
5. Deploy to WordPress.org

## Questions or Concerns?
Contact Williams Obi:
- Website: [williamsobi.com.ng](https://williamsobi.com.ng)
- GitHub: [github.com/willy4opera](https://git.com/willy4opera)
- Phone: +234 803 075 6350

