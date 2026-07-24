<?php

/**
 * Render the Table of Contents markup.
 *
 * @since 2.0
 */

function md_toc( $args = array() ) {
	$args = wp_parse_args( $args, array(
		'title' => __( 'Table of Contents', 'md-toc' )
	) );
	$classes = array( 'toc' );

	if ( isset( $args['widget_id'] ) && md_module( array( 'layout', 'toc', 'add' ) ) )
		return;

	if ( isset( $args['widget_id'] ) || md_module( array( 'layout', 'toc', 'sticky' ) ) )
		$classes[] = 'sticky';

	$classes = join( ' ', $classes );
	$headings = md_post_meta( array( 'table_of_contents', 'list' ) );

	if ( empty( $headings ) )
		return;

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

	include md_template( 'dropins', 'table-of-contents/html', true );
}
