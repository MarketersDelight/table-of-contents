# Table of Contents

A [Marketers Delight](https://marketersdelight.com/) drop-in that builds a table of contents from the H2–H6 headings in a post. Add it at the top of the post, in the left or right gutter, or in a sidebar widget. As the reader scrolls, it highlights the section they're in.

## Features

- Built from H2–H6 headings. H3–H6 headings are grouped under the H2 before them in collapsible sublists.
- Three placements: top of post, left gutter or right gutter. Also available as a sidebar widget.
- Highlights the current section while scrolling, and opens its sublist
- Smooth scrolling to a heading on click, and updates the URL hash. Links to a heading (`#heading`) scroll to it on page load.
- Optional sticky mode. At the top of a post, the table of contents collapses into a bar that stays on screen as you scroll and expands on click.
- Gutter placements need a Layout with no sidebar and no page builder. Otherwise the table of contents shows at the top of the post.
- On screens under 900px, it shows as an expandable bar fixed to the bottom of the screen
- Scroll positions account for the WordPress admin bar and MD's sticky header
- Semantic markup: `<nav>` with an ordered list, plus `aria-expanded` and `aria-controls` on the toggles
- Styles and scripts are added to MD's compiled stylesheet and scripts

## Settings

**Layout settings**: on a post type's global Layout or a single post's Layout:

- **Add Table of Contents** (on a single post, this shows as **Remove Table of Contents** when the post type already adds it)
- **Make sticky** (or **Disable sticky** when the post type is already sticky)
- **Position**: Top of post (default), Left gutter or Right gutter

**Widget** (Appearance → Widgets): **MD → Table of Contents**, with a **Title** field. It only shows on single posts. The widget sticks in the sidebar, and it stays hidden when the Layout already adds a table of contents.

Headings are read when a post is saved. Posts written before you install the drop-in need to be saved again before a table of contents shows on them.

## Developers

- `md_toc_headings`: filter the heading list for the current post. Arguments: `$headings` (each item holds `tag`, `id` and `text`) and `$post_id`.
- `md_toc_html`: add HTML after the list, inside the table of contents. Arguments: `$html` (empty string), `$args` and `$post_id`.

## Requirements

- Marketers Delight 6.0 or later
- WordPress 6.6 or later
- PHP 7.4 or later

## Install

1. Download the latest `table-of-contents-x.y.z.zip` from the [Releases page](https://github.com/MarketersDelight/table-of-contents/releases).
2. In WordPress, go to MD's Drop-ins screen, click **Add new**, and upload the zip.
3. Activate Table of Contents, then add it to a Layout or add the **MD → Table of Contents** widget to a sidebar.

Don't use **Code → Download ZIP**. That zip includes development files and a folder name that MD won't recognize.

## License

GPL-2.0-or-later. See [LICENSE](LICENSE).
