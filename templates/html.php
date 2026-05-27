<nav id="table_of_contents" class="toc" aria-label="<?php echo __( 'Table of contents', 'md-table-of-contents' ); ?>">

	<?php if ( $args['title'] )
		echo $args['before_title'] . md_icon( 'book' ) . '<span class="widget-title-label">' . esc_html( $args['title'] ) . '</span>' . md_icon( 'angle-down', array( 'classes' => 'toc-trigger' ) ) . $args['after_title']; ?>

	<ol class="toc-list">

		<?php foreach ( $groups as $fields ) : ?>

		<li class="toc-item toc-<?php echo esc_attr( $fields['tag'] ); ?>" data-toc-id="<?php echo esc_attr( $fields['id'] ); ?>">

			<div class="toc-item-title">
				<a class="toc-item-label" href="#<?php echo esc_attr( $fields['id'] ); ?>"><?php echo esc_html( $fields['text'] ); ?></a>
				<?php if ( ! empty( $fields['children'] ) ) : ?>
				<span class="toggle trigger" data-toggle="toc-item">
					<?php echo md_icon( 'angle-down', array( 'classes' => 'toc-trigger' ) ); ?>
				</span>
				<?php endif; ?>
			</div>

			<?php if ( ! empty( $fields['children'] ) ) : ?>

			<ul class="toc-sublist">

				<?php foreach ( $fields['children'] as $child ) : ?>
				<li class="toc-item toc-<?php echo esc_attr( $child['tag'] ); ?>" data-toc-id="<?php echo esc_attr( $child['id'] ); ?>">
					<div class="toc-item-title">
						<a class="toc-item-label" href="#<?php echo esc_attr( $child['id'] ); ?>"><?php echo esc_html( $child['text'] ); ?></a>
					</div>
				</li>
				<?php endforeach; ?>

			</ul>

			<?php endif; ?>

		</li>

		<?php endforeach; ?>

	</ol>

</nav>