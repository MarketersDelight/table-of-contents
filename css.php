<style type="text/css">

/*------------------------------*\
	$TABLE OF CONTENTS
\*------------------------------*/

.toc .widget-title {
	align-items: center;
	display: flex;
	gap: <?php echo $third; ?>px;
}

.toc .widget-title-label { flex: 1; }

.toc-list { list-style: none; }

.toc-list .toc-item { margin-block-end: 0; }

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

@media (min-width: 900px) {
	.sidebar .widget_md_table_of_contents_widget {
		background-color: <?php echo $colors['site']['bg_color']; ?>;
		padding-block-start: <?php echo $single; ?>px;
		position: sticky;
			inset-block-start: 0;
	}
	.admin-bar .sidebar .widget_md_table_of_contents_widget { padding-block-start: calc(var(--wp-admin--admin-bar--height) + <?php echo $single; ?>px); }
	.toc .widget-title .toc-trigger { display: none; }
	.format .widget .toc-list { margin-inline-start: -<?php echo $half; ?>px; }
}

@media (max-width: 900px) {
	.toc {
		background-color: <?php echo $colors['site']['accent']; ?>;
		border-block-start: 1px solid <?php echo $colors['site']['tertiary']; ?>;
		position: fixed;
			inset-block-end: 0;
			inset-inline: 0;
	}
	.toc .widget-title {
		cursor: pointer;
		margin-block-end: 0;
		padding: <?php echo $half; ?>px;
	}
	.toc.open .widget-title {
		border-block-end: 1px solid <?php echo $colors['site']['tertiary']; ?>;
		padding-block-end: <?php echo $half; ?>px;
	}
	.toc .toc-list {
		display: none;
		padding: <?php echo $half; ?>px;
	}
	.toc.open .toc-list { display: block; }
}