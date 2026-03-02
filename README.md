# WP Eternal Theme

WordPress theme for [One World by Night](https://owbn.net). Built on Elementor with WP Dark Mode integration.

**Version:** 2.3.0
**Requires:** WordPress 6.0+ / PHP 7.4+
**License:** GPL-2.0-or-later

## Installation

1. Upload `wp-eternal-theme-x.x.x.zip` via **Appearance > Themes > Add New > Upload Theme**
2. Activate and follow the TGM prompt to install required plugins
3. Default header/footer templates are auto-created in Elementor Theme Builder on activation

**Required plugins:** Elementor, Elementor Pro, WP Dark Mode
**Optional:** BetterDocs (author-scoped docs), TablePress (author-scoped tables), Open Accessibility

## Changelog

### 2.3.0
- Stripped comment bloat and redundant PHPDoc
- Updated stale documentation

### 2.2.1
- Fixed dark mode Elementor color variable fallbacks
- Universal dark mode text inheritance
- Dark mode header nav fix

### 2.1.0
- Header spacing fix

### 2.0.0
- Rebuilt as standalone theme (was Hello Elementor child)
- Modular `inc/` architecture
- Auto-provisioned Elementor header/footer templates
- WP Dark Mode CSS custom property integration
- TGM Plugin Activation for dependency management
