<style type="text/css">

/*------------------------------*\
	$TABLE OF CONTENTS
\*------------------------------*/

.sidebar .widget_md_table_of_contents_widget {
	position: sticky;
		inset-block-start: 0;
}

.admin-bar .sidebar .widget_md_table_of_contents_widget { inset-block-start: calc(var(--wp-admin--admin-bar--height) + <?php echo $single; ?>px); }

.toc .widget-title {
	align-items: center;
	display: flex;
	gap: <?php echo $third; ?>px;
}

.toc .widget-title-label { flex: 1; }

.toc-list { list-style: none; }

.format .widget .toc-list { margin-inline-start: -<?php echo $half; ?>px; }

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

.toc-item .toggle { padding: <?php echo $small; ?>px <?php echo $half; ?>px; }

.toc-sublist { display: none; }

.toc-item:is(.active, .child-active, .toggle-toc-item) .toc-sublist { display: block; }
.toc-item:is(.active, .child-active, .toggle-toc-item) .trigger-icon:before { content: '\e817'; }

@media (min-width: 900px) {
	.toc .toc-title-icon { display: none; }
}