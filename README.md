# WP Eternal Theme

A standalone WordPress theme built for the [One World by Night](https://owbn.net) community. Designed around Elementor and WP Dark Mode, the theme reflects the dark, atmospheric aesthetic of the Classic World of Darkness with full day/night visual modes.

## Version 2.1.4

Released February 2026. Fixes dark mode across the board.

### Fixes

- **Missing Elementor color variables (root cause)** — the theme's dark mode CSS relied on three custom Elementor global colors (`--e-global-color-bcd8248`, `--e-global-color-42f8237`, `--e-global-color-e21451c`) that were never defined in the site's Elementor settings. Every `var()` reference resolved to nothing, making all dark mode text, button, and accent rules silently fail. Added `:root` fallback definitions using OWBN brand colors
- **Universal dark mode text** — all content inherits the body's light text color in dark mode via `color: inherit !important` on `body *`, overriding hardcoded dark colors from plugins and widgets
- **Dark mode header nav** — menu links and dropdown arrows in the fixed header stay white in dark mode
- **Dark mode table variable** — `--wp-eternal-table-row-text` changed from `#000` to `#fff` in dark mode

## Version 2.1.0

Released February 2026. Header spacing fix and improvements.

## Version 2.0.0

Released February 2026. Complete rebuild from the former Hello Elementor child theme into a self-contained, modular WordPress theme.

### What's New

- **Standalone theme** — no longer depends on Hello Elementor as a parent
- **Modular architecture** — `functions.php` loads focused modules from `inc/`
- **Auto-provisioned header and footer** — Elementor Theme Builder templates are created on activation
- **TGM Plugin Activation** — required and recommended plugins declared with admin notices
- **Security hardened** — nonce verification, capability checks, input sanitization, no inline scripts
- **WCAG accessible** — skip links, focus indicators, screen-reader text, keyboard navigation
- **WP Dark Mode integration** — CSS custom properties for seamless light/dark switching
- **Responsive** — tested across five breakpoints (1280, 1024, 991, 767, 480 px)
- **Open Accessibility support** — recommended plugin for OpenDyslexic font and accessibility toolbar

## Requirements

| Dependency | Required | Notes |
| --- | --- | --- |
| WordPress | 6.0+ | Tested up to 6.8 |
| PHP | 7.4+ | |
| Elementor | Yes | Free — drag-and-drop page builder |
| Elementor Pro | Yes | Theme Builder for header/footer/archive/single templates |
| WP Dark Mode | Yes | Day/night toggle with CSS variable integration |
| BetterDocs | No | Documentation post type with author-scoped filtering |
| TablePress | No | Table management with author-scoped access control |
| Open Accessibility | No | Accessibility toolbar with OpenDyslexic font support |

## Installation

1. Download the latest `wp-eternal-theme-x.x.x.zip` from this repository.
2. In WordPress, go to **Appearance > Themes > Add New > Upload Theme**.
3. Upload the zip and activate.
4. Follow the TGM prompt to install required plugins (Elementor, Elementor Pro, WP Dark Mode).
5. The theme auto-creates default header and footer templates in Elementor Theme Builder on activation. Customize them from **Elementor > Theme Builder**.

## File Structure

```text
wp-eternal-theme/
  functions.php              Modular loader + constants
  style.css                  Theme header + all custom CSS
  header.php                 HTML head + Elementor header location
  footer.php                 Elementor footer location + closing tags
  index.php                  Main template (WordPress required)
  singular.php               Single post/page fallback
  archive.php                Archive/listing fallback
  search.php                 Search results fallback
  404.php                    Not found fallback
  comments.php               Comments template
  admin-style.css            Admin-only styles
  screenshot.png             Theme screenshot
  inc/
    theme-setup.php          after_setup_theme, theme supports, menus
    enqueue.php              Asset loading (CSS + JS)
    elementor.php            Elementor Theme Builder location registration
    elementor-templates.php  Auto-create header/footer on activation
    plugin-dependencies.php  TGM Plugin Activation config
    betterdocs.php           Optional BetterDocs integration
    tablepress.php           Optional TablePress integration
    admin.php                Admin menu customizations
    tgm/
      class-tgm-plugin-activation.php  TGM library v2.6.1
  assets/
    js/theme.js              Frontend JS (header scroll effect)
    images/                  Theme image assets
  admin-js/
    custom-admin.js          TablePress admin filtering
  template-parts/
    header.php               Fallback header (no Elementor)
    footer.php               Fallback footer (no Elementor)
  languages/                 Translation-ready (.pot)
```

## OWBN Plugin Ecosystem

The following OWBN plugins are fully compatible and self-contained (no theme code required):

- wp-voting-plugin
- owbn-chronicle-plugin
- player-id-plugin
- accessSchema / accessSchema-client
- beyond-elysium
- bp-characters
- bylaw-clause-manager
- owbn-board
- owbn-client
- owbn-territory-manager

## License

GPL-2.0-or-later
