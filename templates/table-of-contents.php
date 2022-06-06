<div id="table_of_contents" class="toc">

	<div class="toc-inner">

		<p id="toc_title" class="toc-title">
			<?php echo md_icon( 'book' ); ?>
			<?php echo $this->name; ?>
			<?php echo md_icon( 'angle-down', array( 'classes' => 'toc-title-icon' ) ); ?>
		</p>
	
		<<?php echo $html; ?> class="toc-list">
			<?php foreach ( $headings as $order => $fields ) : if ( ! empty( $show_headings ) && empty( $show_headings[$fields['tag']] ) ) continue; ?>
				<li data-toc-id="<?php echo esc_attr( $fields['id'] ); ?>" class="toc-item toc-<?php echo esc_attr( $fields['tag'] ); ?>" data-toc-order="<?php echo esc_attr( $order ); ?>"><?php echo esc_html( $fields['text'] ); ?></li>
			<?php endforeach; ?>
		</<?php echo $html; ?>>

	</div>

</div>