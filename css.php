<style type="text/css">

/*------------------------------*\
	$TABLE OF CONTENTS
\*------------------------------*/

.toc { background-color: var(--md-content-main-background); }

.toc .widget-title {
	align-items: center;
	display: flex;
	gap: var(--md-third);
}

.toc .widget-title-label { flex: 1; }

.toc ol { list-style: none; }

.format .toc ol { margin-inline-start: 0; }

.toc .widget-title, .toc-list .toc-item { margin-block-end: 0; }

.toc-item-title {
	align-items: center;
	display: flex;
	transition: 0.2s;
}

.toc-item-title:hover {
	background-color: rgba(0, 0, 0, 0.05);
	border-radius: var(--md-border-radius);
}

.toc-item-label {
	border-inline-start: 3px solid transparent;
	display: block;
	flex: 1;
	padding: var(--md-small) var(--md-half);
	transition: 0.2s;
}

.toc-item-title:hover .toc-item-label { border-radius: var(--md-border-radius) 0 0 var(--md-border-radius); }

.active > .toc-item-title .toc-item-label {
	border-color: var(--md-links);
	color: var(--md-links);
	font-weight: var(--md-bold);
	text-decoration: none;
}

.toc-h3 .toc-item-label { padding-inline-start: calc(var(--md-half) + var(--md-third)); }
.toc-h4 .toc-item-label { padding-inline-start: calc(var(--md-half) + var(--md-third) * 2); }
.toc-h5 .toc-item-label { padding-inline-start: calc(var(--md-half) + var(--md-third) * 4); }
.toc-h6 .toc-item-label { padding-inline-start: calc(var(--md-half) + var(--md-third) * 6); }

.toc-item .toc-trigger { padding: var(--md-small) var(--md-half); }

.toc-sublist { display: none; }

.toc-item:is(.active, .child-active, .toggle-toc-item) .toc-sublist { display: block; }
.toc.open .widget-title .toc-trigger:before,
.toc-item:is(.active, .child-active, .toggle-toc-item) .toc-trigger:before { content: '\e817'; }

/* QUERIES */

@media (min-width: 900px) {
	.toc:not(:last-child) { margin-block-end: var(--md-single); }
	.toc.stuck {
		position: sticky;
			inset-block-start: 0;
			inset-inline: 0;
	}
	.widget .toc .toc-list { margin-inline-start: calc(-1 * var(--md-half)); }
	.sidebar .toc { background-color: var(--md-sidebar-background); }
	.sidebar .toc.stuck { padding-block-start: var(--md-single); }
	.sidebar .toc .widget-title { margin-block-end: var(--md-half); }
	.sidebar .widget-title .toc-trigger { display: none; }
	.header.sticky + .main .sidebar .toc.stuck { padding-block-start: var(--md-triple); }
	.admin-bar .toc.stuck { padding-block-start: var(--wp-admin--admin-bar--height); }
	.admin-bar .sidebar .toc.stuck { padding-block-start: calc(var(--wp-admin--admin-bar--height) + var(--md-half)); }
	.admin-bar .header.sticky + .main .sidebar .toc.stuck { padding-block-start: calc(var(--wp-admin--admin-bar--height) + var(--md-triple)); }
	/* ENTRY */
	.entry .toc {
		border-radius: var(--md-border-radius);
		box-shadow: var(--md-box-shadow);
	}
	.entry .toc.stuck { margin-inline: calc(-1 * var(--md-mid)); }
	.entry .toc .widget-title { padding: var(--md-half) var(--md-single); }
	.entry .toc.stuck .widget-title {
		cursor: pointer;
		font-size: var(--md-h6);
		line-height: var(--md-h6-line-height);
		padding-block: var(--md-small);
	}
	.entry .toc:is(:not(.stuck), .stuck.open) .widget-title { border-block-end: 1px solid var(--md-border); }
	.entry .toc:not(.stuck) .widget-title .toc-trigger, .entry .toc.stuck:not(.open) .toc-list { display: none; }
	.entry .toc-list { padding: var(--md-half); }
}

@media (max-width: 900px) {
	.toc {
		border-block-start: 1px solid var(--md-border);
		position: fixed;
			inset-block-end: 0;
			inset-inline: 0;
		z-index: 82;
	}
	.toc .widget-title {
		cursor: pointer;
		padding: var(--md-half);
	}
	.toc.open .widget-title { border-block-end: 1px solid var(--md-border); }
	.toc .toc-list {
		display: none;
		padding: var(--md-half);
	}
	.toc.open .toc-list { display: block; }
}
