<?php

/**
 * Build the Table of Contents markup.
 *
 * @since 2.0
 */

function md_get_toc( $args = array() ) {
	static $rendered = false;

	$args = wp_parse_args( $args, array(
		'context' => 'inline',
		'floating' => false,
		'title' => __( 'Table of Contents', 'md-toc' )
	) );
	$contexts = array( 'widget', 'inline', 'gutter' );
	$context = in_array( $args['context'], $contexts, true ) ? $args['context'] : 'inline';
	$classes = array( 'toc', "toc-$context" );

	if ( $context === 'widget' && md_module( array( 'layout', 'toc', 'add' ) ) )
		return '';

	if ( $context === 'widget' || md_module( array( 'layout', 'toc', 'sticky' ) ) )
		$classes[] = 'toc-sticky';

	if ( $context === 'inline' && $args['floating'] )
		$classes[] = 'toc-float';

	$classes = join( ' ', $classes );
	$headings = md_post_meta( array( 'table_of_contents', 'list' ) );

	if ( empty( $headings ) )
		return '';

	if ( $rendered )
		return '';

	$rendered = true;

	$current = null;
	$groups = array();

	foreach ( $headings as $fields ) {
		if ( $fields['tag'] === 'h2' ) {
			$fields['children'] = array();
			$groups[] = $fields;
			$current = count( $groups ) - 1;
		}
		else {
			if ( $current !== null )
				$groups[$current]['children'][] = $fields;
			else {
				$fields['children'] = array();
				$groups[] = $fields;
			}
		}
	}

	$toc_id = 'table_of_contents';
	$title_id = $toc_id . '_title';
	$list_id = $toc_id . '_list';

	ob_start();
	include md_template( 'dropins', 'table-of-contents/html', true );

	return ob_get_clean();
}

/**
 * Render the Table of Contents markup.
 *
 * @since 2.0
 */

function md_toc( $args = array() ) {
	echo md_get_toc( $args );
}
