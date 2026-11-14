# Building Pages

How pages on OWbN's sites are made: in Elementor, between the theme's header and footer.

## Who can use this

Anyone who can edit pages on the site.

## How to get there

wp-admin → **Pages** → **Add New Page**, then **Edit with Elementor**.

## The screen

- Elementor's editor: the widgets on the left, the page on the right.
- The OWbN widgets, such as chronicle lists and OAT pages, are in the widget list when OWBN Core has that data switched on.
- The header and footer come from the theme; they're not part of the page.

## Common tasks

### Make a page

1. Click **Add New Page** and give it a title.
2. Click **Edit with Elementor**.
3. Drag widgets onto the page.
4. Click **Publish**.

### Keep a page on-brand

1. For any colour, pick one of the **Global Colors** (the globe in the colour picker) instead of typing a code.
2. For text, pick one of the **Global Fonts** the same way.

## Things to know

- Global colours follow dark mode; a colour typed in by hand doesn't, and can turn unreadable when a reader switches.
- A page without Elementor still shows, with the theme's plain styles.

## Troubleshooting

- **No Edit with Elementor button.** Elementor isn't active, see [Required Plugins](required-plugins.md).
- **An OWbN widget is missing.** Its data type is switched off in **OWBN Core** → **Settings**.
- **Text vanishes in dark mode.** It has a hand-typed colour. Switch it to a global colour.

## Related

- [Brand Colours and Dark Mode](brand-colors.md)
- [Header and Footer](header-and-footer.md)
- [WP Eternal Theme Overview](../overview.md)
