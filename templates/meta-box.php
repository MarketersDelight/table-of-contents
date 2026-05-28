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

$fields->field( 'toc_align', array(
	'type' => 'select',
	'empty_label' => __( 'Show inline (default)', 'md-toc' ),
	'style' => 'width: 100%',
	'options' => array(
		'left' => __( 'Align left', 'md-toc' ),
		'right' => __( 'Align right', 'md-toc' )
	)
) );

echo '</div></div>';
