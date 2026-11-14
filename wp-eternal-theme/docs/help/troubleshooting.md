# Theme Troubleshooting

Fixes for what goes wrong most with the theme: a missing header, colours in dark mode, and missing plugins.

## Who can use this

Site admins and page editors.

## How to get there

Most fixes start from wp-admin → **Appearance**.

## The screen

Most fixes use [Header and Footer](header-and-footer.md) and [Required Plugins](required-plugins.md).

## Common tasks

### Bring back a deleted header or footer

1. Go to **Appearance** → **Themes** and switch to another theme.
2. Switch back to WP Eternal Theme. It makes any missing header or footer again.

## Things to know

- The header and footer need Elementor and Elementor Pro.
- Colours follow dark mode only when they're global colours.

## Troubleshooting

- **The header or footer is missing or plain.** Elementor Pro isn't active, or the templates aren't shown on the entire site. See [Header and Footer](header-and-footer.md).
- **No menu in the header.** In **Appearance** → **Menus**, tick **Header** under **Display location** for a menu.
- **Text is unreadable in dark mode.** It uses a typed-in colour; switch it to a global colour.
- **The site shows an error after a WP Dark Mode update.** Its two parts are on different versions. Update both to the same one.
- **An author can't find a doc or a table.** It belongs to another author, see [Docs and Tables for Authors](author-tools.md).

## Related

- [Header and Footer](header-and-footer.md)
- [Required Plugins](required-plugins.md)
- [WP Eternal Theme Overview](../overview.md)
