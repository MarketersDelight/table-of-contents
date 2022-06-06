<div id="table_of_contents" class="md-widget md-toggle md-sep-small">

	<h3 class="md-widget-title"><?php echo md_text_field( $name ); ?></h3>

	<div class="md-widget-item">
		<div class="md-sep-small">
			<?php $this->fields->field( 'headings', array(
				'type' => 'checkbox',
				'label' => __( 'Show headings', 'md-toc' ),
				'description' => __( 'Shows all heading levels <code>h2</code>-<code>h6</code> by default. Select only the headings you wish to show on each article.', 'md-toc' ),
				'inline' => true,
				'options' => $options
			) ); ?>
		</div>
		<div class="md-sep-small">
			<?php $this->fields->field( 'style', array(
				'type' => 'checkbox',
				'label' => __( 'Style', 'md-toc' ),
				'options' => array(
					'numbers' => __( 'Add numbers to TOC headings list', 'md-toc' ),
					'hide_indent' => __( 'Do not indent heading levels', 'md-toc' )
				)
			) ); ?>
			<?php $this->fields->field( 'alignment', array(
				'type' => 'select',
				'description' => __( 'Select the side of the content box to show the TOC on full-width pages.', 'md-toc' ),
				'options' => array(
					'' => __( 'Select alignment...', 'md-toc' ),
					'left' => __( 'Align left (defult)', 'md-toc' ),
					'right' => __( 'Align right', 'md-toc' )
				)
			) ); ?>
		</div>
		<div class="md-sep-small">
			<?php $this->fields->field( 'start_position', array(
				'type' => 'number',
				'label' => __( 'Top Starting Position', 'md-toc' ),
				'placeholder' => ( $single * 8 ),
				'description' => __( '<b>Full-width pages only:</b> Set the top starting position before the TOC is fixed to the page on scroll.', 'md-toc' ),
				'unit' => 'px'
			) ); ?>
		</div>
	</div>

</div>