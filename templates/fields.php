<div class="md-conditional md-sep-small-top<?php echo $invert ? ' md-conditional-invert' : ''; ?>">

<?php

$fields->field( 'toc', array(
	'type' => 'checkbox',
	'label' => __( 'Table of Contents', 'md-toc' ),
	'classes' => 'md-conditional-option',
	'options' => array(
		$toggle => $toggle_label
	)
) );
?>

<div class="md-conditional-item md-conditional-1<?php echo $show_options ? ' is-condition' : ''; ?>">

<?php

$fields->field( 'toc', array(
	'type' => 'checkbox',
	'options' => array(
		'sticky' => $sticky_label
	)
) );

$fields->field( 'toc_position', array(
	'type' => 'select',
	'empty_label' => $position_label,
	'options' => $position_options
) );
?>

</div>

</div>
