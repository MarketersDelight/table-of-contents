<div class="md-sep-small">
	<?php $this->fields->field( 'headings', array(
		'type' => 'checkbox',
		'label' => __( 'Show headings', 'md-toc' ),
		'description' => __( 'Shows the default heading levels according to <b>MD > Settings > Content > TOC</b> options. Set custom headings here.', 'md-toc' ),
		'inline' => true,
		'options' => $options
	) ); ?>
</div>

<div class="columns-3 columns-single">

	<div class="col">
		<?php $this->fields->field( 'alignment', array(
			'type' => 'select',
			'label' => __( 'Style', 'md-toc' ),
			'description' => __( 'Select the side of the content box to show the TOC on full-width pages.', 'md-toc' ),
			'options' => array(
				'' => __( 'Select alignment...', 'md-toc' ),
				'left' => __( 'Align left (defult)', 'md-toc' ),
				'right' => __( 'Align right', 'md-toc' )
			)
		) ); ?>
	</div>
	
	<div class="col">
		<?php $this->fields->field( 'start_position', array(
			'type' => 'number',
			'label' => __( 'Top Starting Position', 'md-toc' ),
			'placeholder' => ( $single * 8 ),
			'description' => __( 'Adjust the top starting position of TOC before it scrolls on full-width pages.', 'md-toc' ),
			'unit' => 'px'
		) ); ?>
	</div>

</div>