<?php

echo '<div class="md-conditional">';

$fields->field( 'toc', array(
	'type' => 'checkbox',
	'label' => __( 'Table of Contents', 'md-toc' ),
	'classes' => 'md-conditional-option',
	'options' => array(
		'add' => __( 'Add <b>Table of Contents</b>', 'md-toc' )
	)
) );

echo '<div class="md-conditional-item md-conditional-1' . ( $fields->module( array( 'toc', 'add' ) ) ? ' is-condition' : '' ) . '">';

$fields->field( 'toc', array(
	'type' => 'checkbox',
	'options' => array(
		'sticky' => __( 'Make sticky', 'md-toc' )
	)
) );

$fields->field( 'toc_position', array(
	'type' => 'select',
	'label' => __( 'Placement', 'md-toc' ),
	'description' => __( 'Gutter positions apply to expanded layouts without a sidebar. Other layouts display the table of contents at the top of the post.', 'md-toc' ),
	'options' => array(
		'gutter-left' => __( 'Left gutter', 'md-toc' ),
		'gutter-right' => __( 'Right gutter', 'md-toc' ),
		'inline' => __( 'Top of post', 'md-toc' )
	)
) );

echo '</div></div>';
