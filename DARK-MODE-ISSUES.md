# WP Eternal Theme — Dark Mode Issues Log

Summary of dark mode issues found on [chronicles.owbn.net](https://chronicles.owbn.net/) and fixes applied.

## Issue 1: Header nav links wrong color in dark mode

**Status:** Fixed in 2.1.1

**Symptom:** Menu links and dropdown arrows in the fixed header turned cyan (the WP Dark Mode "Sweet Dark" preset link color `#04E2FF`) instead of staying white.

**Root cause:** The theme's generic dark mode link rule (line ~913 in `style.css`) uses an extremely high-specificity selector (`0,9,3`) that sets `color: unset !important` on all `<a>` tags. The simpler `.main--header .elementor-item` rule (`0,2,0`) lost the specificity battle, so nav links fell through to the plugin's preset color.

**Fix:** Added dark mode-specific selectors for `.main--header` nav elements with matching specificity (`0,8,3`+), placed after the generic rule so they win by cascade order. Covers normal, hover, focus states, and sub-arrow SVGs.

---

## Issue 2: Table/content text unreadable in dark mode

**Status:** Fixed in 2.1.3 (universal approach)

**Symptom:** On `/chronicles/` and similar pages, all body content (text, headings, grid rows) appeared as black text on a dark background — completely unreadable in dark mode. Page titles were also black-on-dark.

**Root cause (multi-layered):**

1. **CSS variable bug** — `--wp-eternal-table-row-text` was hardcoded to `#000` in both `:root` (dark mode) and the light-mode override. Fixed to `#fff` in `:root`.

2. **Table-only targeting (2.1.2, insufficient)** — Initial fix only added dark mode rules for `<table>`, `<td>`, `<th>`, and DataTables controls. The chronicles page doesn't use `<table>` at all — the `owbn-chronicle-plugin` renders div-based grids (`.chron-wrapper`, `.chron-field`, `.owbn-chronicle-card`, etc.) with hardcoded dark text colors like `color: #333`.

3. **WP Dark Mode plugin not overriding plugin CSS** — The WP Dark Mode plugin should invert colors universally, but the theme's own dark mode CSS interferes. Specifically, the `color: unset !important` rule on links (line ~913) and the high-specificity body color rule fight with the plugin's injected styles, creating gaps where content elements keep their original dark colors.

**Fix (2.1.3 — universal):** Replaced the table-specific rules with a single universal rule:

```css
html.wp-dark-mode-active:not([data-wp-dark-mode-preset="0"]) body
  *:not(.wp-dark-mode-ignore *)
   :not(.wp-dark-mode-switch *)
   :not(.elementor-button *) {
    color: inherit !important;
}
```

This forces ALL content elements to inherit the body's light text color (`var(--e-global-color-bcd8248)`), overriding any hardcoded dark colors from plugins/widgets. Exclusions:
- `.wp-dark-mode-ignore *` — elements explicitly opted out of dark mode
- `.wp-dark-mode-switch *` — the toggle button itself
- `.elementor-button *` — button text (has its own dark mode rules)

The header nav fix has higher specificity (`0,8,3` vs `0,5,2`) and still applies correctly.

---

## Architecture Notes

### How WP Dark Mode works in this theme

- The **WP Dark Mode plugin** (v5.3.3) adds `html.wp-dark-mode-active` class and `html[data-wp-dark-mode-active]` attribute when dark mode is active
- The plugin injects its own CSS to invert colors based on the active preset ("Sweet Dark")
- The **theme** layers its own dark mode CSS on top (lines ~896–1013 in `style.css`) using these selectors with `:not([data-wp-dark-mode-preset="0"])` guards
- CSS custom properties in `:root` define dark mode defaults; light mode overrides them inside `html:not(.wp-dark-mode-active)`

### Key CSS variables

| Variable | Dark mode (`:root`) | Light mode |
| --- | --- | --- |
| `--wp-eternal-header-bg` | `rgba(4,4,11,0.45)` | `rgba(4,4,11,0.9)` |
| `--wp-eternal-card-bg` | dark gradient | light gradient |
| `--wp-eternal-table-text` | `#fff` | `#333` |
| `--wp-eternal-table-row-text` | `#fff` (was `#000`) | `#000` |
| `--wp-eternal-link-accent` | `#ff584e` | `#d9443b` |

### Elementor global color references

These Elementor variables are used throughout the dark mode CSS but their values are defined in Elementor's settings (not in the theme CSS):

- `--e-global-color-bcd8248` — light/body text color (used for dark mode body text)
- `--e-global-color-42f8237` — white/highlight text (used for button text, view buttons)
- `--e-global-color-e21451c` — red accent (used for buttons, hover states)
- `--e-global-color-accent` — Elementor accent color (used for SVG fills)

### Chronicle plugin structure

The `owbn-chronicle-plugin` does NOT use `<table>` elements. It renders:
- **Grid rows:** `.chron-wrapper` / `.chron-list-wrapper` with CSS Grid (7 columns)
- **Fields:** `.chron-field`, `.chron-title`
- **Card layout:** `.owbn-chronicle-card`, `.owbn-chronicle-card-wrapper`
- **Hardcoded colors in plugin CSS:** `color: #333`, `background: #f8f9fa`, `background: #e9ecef`

These hardcoded light-mode colors resist the WP Dark Mode plugin's inversions, which is why the universal `color: inherit` rule was needed.

---

## Potential Follow-ups

- **Background colors:** The chronicle plugin's row backgrounds (`.chron-wrapper.even` = `#f8f9fa`, `.chron-wrapper.odd` = `#e9ecef`) may still appear as light stripes in dark mode if the WP Dark Mode plugin doesn't catch them. May need explicit dark mode background overrides.
- **Vote result tables:** `.vote--result--area table tbody tr *` forces `--wp-eternal-table-row-text` (now `#fff`). If vote tables have light-colored row backgrounds that the plugin preserves, white text on light rows could be an issue. Monitor after deployment.
- **Elementor inline styles:** Elementor can set colors via inline `style` attributes. The universal `color: inherit !important` rule overrides inline styles without `!important`, but Elementor rarely uses `!important` inline so this should work.
