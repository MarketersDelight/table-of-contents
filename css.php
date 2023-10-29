<style type="text/css">

/*------------------------------*\
	$TABLE OF CONTENTS
\*------------------------------*/

.toc-inner { border-radius: 5px; }

.style-default .toc-inner { background-color: <?php echo $colors['content']['bg_color']; ?>; }
.style-minimal .toc-inner { background-color: <?php echo $colors['site']['bg_color']; ?>; }

.toc .toc-title {
	cursor: pointer;
	margin-bottom: <?php echo $half; ?>px;
}

.toc-title [class*="md-icon-"] {
	color: <?php echo $colors['site']['primary']; ?>;
	margin-right: <?php echo $small; ?>px;
}

.toc-title-icon {
	border-radius: 50%;
	display: none;
	height: <?php echo $half + $third; ?>px;
	float: right;
	text-align: center;
	width: <?php echo $half + $third; ?>px;
}

.toc:hover .toc-title-icon { background-color: rgba(0, 0, 0, 0.2); }

.toc .toc-list {
	margin-left: 0;
	padding-left: <?php echo $half; ?>px;
}

.toc ul.toc-list { list-style: none; }

.toc .toc-item {
	color: <?php echo $colors['site']['text-sec']; ?>;
	cursor: pointer;
	margin-bottom: <?php echo $small; ?>px;
}

.toc .toc-item::marker { color: <?php echo $colors['site']['text']; ?>; }

.toc .toc-item:not(.active):hover { color: <?php echo $colors['site']['text']; ?>; }

.toc-item.active {
	color: <?php echo $colors['site']['primary']; ?>;
	font-weight: <?php echo $bold; ?>;
}

<?php if ( ! md_setting( array( 'table_of_contents', 'style', 'hide_indent' ) ) ) : ?>

.toc-h2:not(:first-child) { margin-top: <?php echo $third; ?>px; }
.toc-h3 { margin-left: <?php echo $half; ?>px; }
.toc-h4 { margin-left: <?php echo $half + $third; ?>px; }
.toc-h5 { margin-left: <?php echo $single; ?>px; }
.toc-h6 { margin-left: <?php echo $single + $half; ?>px; }

<?php endif; ?>

/* STICKY */

.toc.sticky .toc-list {
	border-left: 0;
	display: block;
}

/* FIXED STYLE */

.toc { margin-bottom: <?php echo $single; ?>px; }
.toc.sticky { margin-bottom: 0; }

.toc-fixed .toc.sticky .toc-inner {
	background-color: <?php echo $colors['content']['bg_color']; ?>;
	box-shadow: 0 2px 6px rgba(0, 0, 0, .15);
	height: auto !important;
	position: fixed;
		top: 0;
	z-index: 100;
}

.toc-fixed .toc.sticky .toc-title {
	background-color: <?php echo $colors['site']['accent']; ?>;
	border-bottom: 1px solid rgba(0, 0, 0, 0.15);
	cursor: pointer;
	margin-bottom: 0;
	padding: <?php echo $small; ?>px <?php echo $half; ?>px;
}

.toc-fixed .toc.sticky .toc-title-icon { display: block; }

.toc .toc-list {
	border-left: 3px solid <?php echo $colors['site']['primary']; ?>;
	margin-left: 0;
}

.toc-fixed ol.toc-list { padding-left: <?php echo $mid - $small; ?>px; }

.toc-fixed .toc.sticky .toc-list {
	background-color: <?php echo $colors['site']['accent']; ?>;
	border-left: 0;
	max-height: <?php echo $single * 10; ?>px;
	overflow-y: auto;
	padding: <?php echo $half; ?>px;
}

.toc-fixed ul.toc .toc-item { padding-left: <?php echo $half; ?>px; }

.toc-fixed .toc.sticky .toc-list { display: none; }
.toc-fixed .toc.sticky.open .toc-list { display: block; }

.toc-anchor {
	background-color: rgba(0, 0, 0, 0.07);
	margin-left: <?php echo $third; ?>px;
}

.toc-anchor:before {
	content: '\e827';
	color: <?php echo $colors['site']['primary']; ?>;
	font-family: 'md-icon';
	line-height: 1;
}

.toc-anchor:hover { background-color: rgba(0, 0, 0, 0.1); }

/* FULL-WIDTH STYLE */

.toc-full .toc.sticky .toc-inner {
	position: fixed;
		top: 0;
	z-index: 100;
}

.toc-full ol.toc-list { padding-left: <?php echo $third * 2; ?>px; }

/* QUERIES */

.admin-bar .toc.sticky .toc-inner, .admin-bar .toc-fixed .toc.sticky,
.has-md-admin-bar .toc.sticky .toc-inner, .has-md-admin-bar .toc-fixed .toc.sticky { top: <?php echo $admin_bar_height; ?>px; }

@media all and (min-width: 900px) {
	.toc-full .toc-inner { max-width: <?php echo $gutter_width; ?>px; }
	.toc-full .toc .toc-list { border-left: 0; }
	.toc-full .toc {
		margin-left: -<?php echo ( $gutter_width / $site_width ) * 100; ?>%;
		position: absolute;
	}
	.toc-full.toc-right .toc {
		margin-left: -<?php echo ( $post_width / $site_width ) * 100; ?>%;
		max-width: <?php echo ( $post_width / $site_width ) * 100; ?>%;
	}
	.toc-full.toc-right .toc { margin-left: <?php echo ( $post_width / $site_width ) * 100; ?>%; }
	.toc-full .toc-inner { padding: 0 <?php echo $half; ?>px <?php echo $half; ?>px; }
	.toc-full .toc.sticky .toc-inner { padding-top: <?php echo $half; ?>px; }
	.toc-fixed .toc.sticky .toc-inner { margin-left: -<?php echo $mid; ?>px; }
	.toc .toc-title { cursor: default; }
	.toc .toc-list {
		font-size: 15px;
		line-height: 23px;
	}
	.toc-anchor { display: none; }
	h2:hover .toc-anchor, h3:hover .toc-anchor,
	h4:hover .toc-anchor, h5:hover .toc-anchor,
	h6:hover .toc-anchor { display: inline-flex; }
}

@media all and (min-width: <?php echo $site_width; ?>px) {
	.toc-full .toc.sticky { margin-left: -<?php echo $gutter_width; ?>px; }
	.toc-full.toc-right .toc.sticky { margin-left: <?php echo $post_width; ?>px; }
	.toc-fixed .toc.sticky .toc-inner {
		max-width: <?php echo $content_width; ?>px;
		width: 100%;
	}
}

@media all and (max-width: <?php echo $site_width; ?>px) {
	.full .toc.sticky .toc-inner { max-width: <?php echo ( $gutter_width / $site_width ) * 100; ?>%; }
	.toc.toc-right.sticky .toc-inner { max-width: <?php echo ( $post_width / $site_width ) * 100; ?>%; }
}

@media all and (max-width: 900px) {
	.toc .toc-list {
		font-size: 15px;
		line-height: 23px;
	}
	.toc .toc-inner,
	.toc-fixed .toc.sticky .toc-inner {
		left: 0;
		max-width: 100%;
		width: 100%;
	}
	.full .toc.sticky .toc-inner {
		box-shadow: 0 2px 3px rgba(0, 0, 0, 0.1);
		max-width: 100%;
	}
	.toc.sticky .toc-title {
		background-color: <?php echo $colors['site']['accent']; ?>;
		border-bottom: 1px solid rgba(0, 0, 0, 0.15);
		padding: <?php echo $small; ?>px <?php echo $half; ?>px;
	}
	.toc.sticky .toc-list {
		background-color: <?php echo $colors['site']['accent']; ?>;
		padding: <?php echo $half; ?>px;
	}
	.toc.sticky .toc-list { display: none; }
	.toc-full .toc-list { padding-left: <?php echo $half; ?>px; }
	.toc.sticky .toc-title { margin-bottom: 0; }
	.toc.sticky .toc-title-icon, .toc.sticky.open .toc-list { display: block; }
	.toc.open .toc-title-icon:before { content: '\e817'; }
}

@media all and (max-width: 785px) {
	.admin-bar .toc.sticky .toc-inner { top: <?php echo $admin_bar_height_mobile; ?>px; }
}