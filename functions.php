<?php

/**
 * Render the Table of Contents markup.
 *
 * @since 2.0
 */

function md_toc( $args = array() ) {
	$args = wp_parse_args( $args, array(
		'before_widget' => '',
		'after_widget' => '',
		'title' => '',
		'before_title' => '<p class="toc-title">',
		'after_title' => '</p>'
	) );

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

	echo $args['before_widget'];

	include md_template( 'dropins', 'table-of-contents/html', true );

	echo $args['after_widget'];
}