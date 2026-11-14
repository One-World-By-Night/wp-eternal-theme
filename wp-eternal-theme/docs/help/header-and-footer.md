# Header and Footer

The bar across the top of every page and the strip along the bottom. Both are Elementor templates you can edit like any page.

## Who can use this

Site admins.

## How to get there

wp-admin → **Templates** → **Saved Templates** (on older Elementor, **Elementor** → **My Templates**) → **WP Eternal – Header** or **WP Eternal – Footer**.

## The screen

- **WP Eternal – Header** - the site logo on the left, linked to the home page, and the menu on the right. It stays fixed at the top, and tightens once the reader scrolls down.
- **WP Eternal – Footer** - the copyright line.
- Both show on the entire site.

## Common tasks

### Change the header

1. Open **WP Eternal – Header** with **Edit with Elementor**.
2. Make the change: swap the logo, add a button, restyle the bar.
3. Click **Publish**.

### Put pages in the header menu

1. Go to **Appearance** → **Menus**.
2. Build the menu, tick **Header** under **Display location**, and click **Save Menu**.

### Change the logo

1. Go to **Appearance** → **Customize** → **Site Identity**.
2. Pick the logo and publish.

## Things to know

- The theme makes the two templates the first time it's switched on on a site, and never again while they exist.
- Keep the header's CSS class `main--header`: the scroll effect and the dark-mode styles look for it.
- Both templates need Elementor Pro, which shows them across the site.

## Troubleshooting

- **The header or footer is missing or unstyled.** Check both templates exist and show on the **Entire Site**. If they were deleted, switch to another theme and back: the theme makes them again.
- **No menu in the header.** No menu is assigned to its location. See **Put pages in the header menu**.

## Related

- [Building Pages](building-pages.md)
- [Brand Colours and Dark Mode](brand-colors.md)
- [Theme Troubleshooting](troubleshooting.md)
