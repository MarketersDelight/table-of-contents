<style type="text/css">

/*------------------------------*\
	$TABLE OF CONTENTS
\*------------------------------*/

.main {
	--toc-floating-height: 0;
	--toc-scroll-gap: var(--md-small);
	--toc-sticky-offset: var(--md-half);
}

.header.sticky + .main { --toc-sticky-offset: var(--md-triple); }

.admin-bar .main { --toc-sticky-offset: calc(var(--wp-admin--admin-bar--height) + var(--md-half)); }

.admin-bar .header.sticky + .main { --toc-sticky-offset: calc(var(--wp-admin--admin-bar--height) + var(--md-triple)); }

/* TITLE + TOGGLES */

.toc .widget-title {
	align-items: center;
	display: flex;
	gap: var(--md-third);
	position: relative;
}

.toc .widget-title-label { flex: 1; }

.toc .md-icon-book { color: var(--md-links); }

.toc-toggle, .toc-item-toggle {
	align-items: center;
	appearance: none;
	background: none;
	border: 0;
	color: inherit;
	cursor: pointer;
	display: flex;
	font: inherit;
	justify-content: center;
	line-height: 1;
}

.toc-toggle {
	inset: 0;
	justify-content: flex-end;
	padding: inherit;
	position: absolute;
	width: 100%;
}

/* CONTENT LIST */

.toc ol { list-style: none; }

.format .toc ol { margin-inline-start: 0; }

.toc .widget-title, .toc-list .toc-item { margin-block-end: 0; }

.toc-item-title {
	align-items: center;
	display: flex;
}

.toc-item-title, .toc-item-label { transition: var(--md-transition); }

.toc-item-title:hover {
	background-color: rgba(0, 0, 0, 0.05);
	border-radius: var(--md-border-radius);
}

.toc-item-label {
	border-inline-start: 3px solid transparent;
	color: inherit;
	display: block;
	flex: 1;
	padding: var(--md-small) var(--md-half);
	text-decoration: none;
}

.toc .active > .toc-item-title .toc-item-label {
	border-color: var(--md-links);
	color: var(--md-links);
	font-weight: var(--md-bold);
}

.toc-h3 .toc-item-label { padding-inline-start: calc(var(--md-half) + var(--md-third)); }
.toc-h4 .toc-item-label { padding-inline-start: calc(var(--md-half) + var(--md-third) * 2); }
.toc-h5 .toc-item-label { padding-inline-start: calc(var(--md-half) + var(--md-third) * 4); }
.toc-h6 .toc-item-label { padding-inline-start: calc(var(--md-half) + var(--md-third) * 6); }

.toc-sublist .toc-item-label {
	color: var(--md-text-muted);
	font-size: calc(var(--md-font-size-sm) - 2px);
	line-height: calc(var(--md-line-height-sm) - 2px);
}

.toc-sublist .toc-item {
	margin-inline-start: var(--md-third);
}

.toc-item-toggle { padding: var(--md-small) var(--md-half); }

.toc-trigger { transition: transform var(--md-transition); }

.toc-sublist { display: none; }

.toc-item:is(.active, .child-active, .toggle-toc-item):not(.collapsed-toc-item) .toc-sublist { display: block; }
.toc.open .toc-toggle .toc-trigger,
.toc-item.toggle-toc-item > .toc-item-title .toc-trigger { transform: rotate(180deg); }

/* HEADING POSITION */

.toc-heading { scroll-margin-block-start: calc(var(--toc-sticky-offset) + var(--toc-floating-height) + var(--toc-scroll-gap)); }

.toc-float-anchor {
	display: block;
	height: 0;
}

/* DESKTOP */

@media (min-width: 900px) {
	.toc-toggle { display: none; }

	/* WIDGET */

	.toc-widget .widget-title { margin-block-end: var(--md-half); }
	.toc-widget .toc-list { margin-inline-start: calc(-1 * var(--md-half)); }
	.sidebar .widget_md_table_of_contents_widget {
		background-color: var(--md-content-main-background);
		background-image: linear-gradient(var(--md-sidebar-background), var(--md-sidebar-background));
		padding-block: var(--md-third);
		position: sticky;
			inset-block-start: var(--toc-sticky-offset);
		z-index: 60;
	}

	/* INLINE + GUTTER BOX */

	.toc-inline:not(:last-child) { margin-block-end: var(--md-single); }
	.toc-inline, .toc-gutter {
		background-color: var(--md-content-main-background);
		border-radius: var(--md-border-radius);
		box-shadow: var(--md-box-shadow);
	}
	:is(.toc-inline, .toc-gutter) .widget-title {
		border-block-end: 1px solid var(--md-border);
		padding: var(--md-half) var(--md-single);
	}
	:is(.toc-inline, .toc-gutter) .toc-list { padding: var(--md-half); }

	/* STICKY INLINE */

	.has-toc-float { overflow-anchor: none; }
	.toc-inline.toc-sticky:not(.toc-float),
	.toc.stuck {
		max-height: calc(100vh - var(--toc-sticky-offset) - var(--md-half));
		overflow-y: auto;
		position: sticky;
			inset-block-start: var(--toc-sticky-offset);
		z-index: 60;
	}
	.toc.stuck { margin-inline: calc(-1 * var(--md-mid)); }
	.compact .toc.stuck { inset-block-start: calc(var(--toc-sticky-offset) - var(--md-half)); }
	.toc.stuck .widget-title {
		cursor: pointer;
		font-size: var(--md-h6);
		line-height: var(--md-h6-line-height);
		padding-block: var(--md-small);
	}
	.toc.stuck .toc-toggle { display: flex; }
	.toc.stuck:not(.open) .widget-title { border-block-end: 0; }
	.toc.stuck:not(.open) .toc-list { display: none; }
}

@media (min-width: 900px) and (max-width: <?php echo $site_width; ?>px) {
	.toc-gutter .toc-toggle { display: flex; }
	.toc-gutter:not(.open) .widget-title { border-block-end: 0; }
	.toc-gutter:not(.open) .toc-list { display: none; }
	.toc-gutter.toc-sticky {
		max-height: calc(100vh - var(--toc-sticky-offset) - var(--md-half));
		overflow-y: auto;
		position: sticky;
		inset-block-start: var(--toc-sticky-offset);
		z-index: 20;
	}
	.toc-gutter:not(:last-child) { margin-block-end: var(--md-single); }
}

@media (min-width: <?php echo $site_width; ?>px) {
	.has-toc-gutter .the-content { position: relative; }
	.toc-gutter {
		background-color: transparent;
		box-shadow: none;
		font-size: calc(var(--md-font-size-sm) - 2px);
		line-height: calc(var(--md-line-height-sm) - 1px);
		padding-inline: var(--md-half);
		position: absolute;
		inset-block: 0;
		width: max(0px, calc((100% - var(--md-width-post)) / 2));
	}
	.toc-gutter-left .toc-gutter { inset-inline-start: 0; }
	.toc-gutter-right .toc-gutter { inset-inline-end: 0; }
	.toc-gutter.toc-sticky .toc-inner {
		max-height: calc(100vh - var(--toc-sticky-offset) - var(--md-half));
		overflow-y: auto;
		position: sticky;
		inset-block-start: var(--toc-sticky-offset);
		z-index: 60;
	}
	.toc-gutter .widget-title {
		border-block-end: 0;
		font-family: <?php echo $font_family; ?>;
		font-size: inherit;
		gap: var(--md-small);
		line-height: inherit;
		padding: 0 0 var(--md-third);
	}
	.toc-gutter .toc-list { padding: 0; }
	.toc-gutter .toc-item-label {
		border: 0;
		padding-inline-end: var(--md-small);
	}
	.toc-gutter .toc-sublist .toc-item-label {
		padding-inline-start: 0;
	}
	.toc-gutter .toc-item-title { border-inline-start: 3px solid var(--md-border); }
	.toc-gutter-left .toc-item-title {
		border-inline-end: 3px solid var(--md-border);
		border-inline-start: 0;
	}
	.toc-gutter-left .toc-item-title:hover {
		border-end-end-radius: 0;
		border-start-end-radius: 0;
	}
	.toc-gutter-right .toc-item-title:hover {
		border-end-start-radius: 0;
		border-start-start-radius: 0;
	}
	.toc-gutter .active > .toc-item-title { border-color: var(--md-links); }
	.toc-gutter .toc-h2 .toc-item-label { padding-inline-start: var(--md-third); }
	.toc-gutter .toc-item-toggle { padding-inline: var(--md-half); }
}

@media (max-width: 900px) {
	.toc {
		background-color: var(--md-content-main-background);
		border-block-start: 1px solid var(--md-border);
		position: fixed;
			inset-block-end: 0;
			inset-inline: 0;
		z-index: 82;
	}
	.toc .widget-title { padding: var(--md-half); }
	.toc.open .widget-title { border-block-end: 1px solid var(--md-border); }
	.toc .toc-list {
		display: none;
		max-height: calc(100vh - var(--md-triple));
		overflow-y: auto;
		padding: var(--md-half);
	}
	.toc.open .toc-list { display: block; }
}
