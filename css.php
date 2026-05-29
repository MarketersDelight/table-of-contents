<style type="text/css">

/*------------------------------*\
	$TABLE OF CONTENTS
\*------------------------------*/

.toc { background-color: <?php echo $colors['site']['accent']; ?>; }

.toc .widget-title {
	align-items: center;
	display: flex;
	gap: <?php echo $third; ?>px;
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
	border-radius: 6px;
}

.toc-item-label {
	border-inline-start: 3px solid transparent;
	display: block;
	flex: 1;
	padding: <?php echo $small; ?>px <?php echo $half; ?>px;
	transition: 0.2s;
}

.toc-item-title:hover .toc-item-label { border-radius: 6px 0 0 6px; }

.active > .toc-item-title .toc-item-label {
	border-color: <?php echo $colors['site']['primary']; ?>;
	color: <?php echo $colors['site']['primary']; ?>;
	font-weight: <?php echo $bold; ?>;
	text-decoration: none;
}

.toc-h3 .toc-item-label { padding-inline-start: <?php echo $half + $third; ?>px; }
.toc-h4 .toc-item-label { padding-inline-start: <?php echo $half + ( $third * 2 ); ?>px; }
.toc-h5 .toc-item-label { padding-inline-start: <?php echo $half + ( $third * 4 ); ?>px; }
.toc-h6 .toc-item-label { padding-inline-start: <?php echo $half + ( $third * 6); ?>px; }

.toc-trigger { padding: <?php echo $small; ?>px <?php echo $half; ?>px; }

.toc-sublist { display: none; }

.toc-item:is(.active, .child-active, .toggle-toc-item) .toc-sublist { display: block; }
.toc.open .widget-title .toc-trigger:before,
.toc-item:is(.active, .child-active, .toggle-toc-item) .toc-trigger:before { content: '\e817'; }

/* QUERIES */

@media (min-width: 900px) {
	.toc:not(:last-child) { margin-block-end: <?php echo $single; ?>px; }
	.toc.stuck {
		position: sticky;
			inset-block-start: 0;
			inset-inline: 0;
	}
	.format .toc .toc-list { margin-inline-start: -<?php echo $half; ?>px; }
	.sidebar .toc { background-color: <?php echo $colors['site']['bg_color']; ?>; }
	.sidebar .toc.stuck { padding-block-start: <?php echo $single; ?>px; }
	.sidebar .toc .widget-title { margin-block-end: <?php echo $half; ?>px; }
	.sidebar .widget-title .toc-trigger { display: none; }
	.header.stuck + .main .sidebar .toc.stuck { padding-block-start: <?php echo $triple; ?>px; }
	.admin-bar .toc.stuck { padding-block-start: var(--wp-admin--admin-bar--height); }
	.admin-bar .sidebar .toc.stuck { padding-block-start: calc(var(--wp-admin--admin-bar--height) + <?php echo $half; ?>px); }
	.admin-bar .header.stuck + .main .sidebar .toc.stuck { padding-block-start: calc(var(--wp-admin--admin-bar--height) + <?php echo $triple; ?>px); }
	/* ENTRY */
	.entry .toc {
		border-radius: 6px;
		box-shadow: 0 1px 3px rgba(0, 0, 0, 0.15);
	}
	.entry .toc.stuck { margin-inline: -<?php echo $mid; ?>px; }
	.entry .toc .widget-title, .entry .toc-list { padding: <?php echo $half; ?>px <?php echo $single; ?>px; }
	.entry .toc.stuck .widget-title { cursor: pointer; }
	.entry .toc:is(:not(.stuck), .stuck.open) .widget-title { border-block-end: 1px solid rgba(0, 0, 0, 0.1); }
	.entry .toc:not(.stuck) .widget-title .toc-trigger, .entry .toc.stuck:not(.open) .toc-list { display: none; }
}

@media (max-width: 900px) {
	.toc {
		border-block-start: 1px solid <?php echo $colors['site']['tertiary']; ?>;
		position: fixed;
			inset-block-end: 0;
			inset-inline: 0;
		z-index: 85;
	}
	.toc .widget-title {
		cursor: pointer;
		padding: <?php echo $half; ?>px;
	}
	.toc.open .widget-title { border-block-end: 1px solid <?php echo $colors['site']['tertiary']; ?>; }
	.toc .toc-list {
		display: none;
		padding: <?php echo $half; ?>px;
	}
	.toc.open .toc-list { display: block; }
}