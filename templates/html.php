<nav id="<?php echo esc_attr( $toc_id ); ?>" class="<?php echo esc_attr( $classes ); ?>" aria-labelledby="<?php echo esc_attr( $title_id ); ?>">

	<div class="toc-inner">

		<div class="widget-title">

			<?php echo md_icon( 'book' ); ?>

			<span id="<?php echo esc_attr( $title_id ); ?>" class="widget-title-label"><?php echo esc_html( $args['title'] ); ?></span>

			<button class="toc-toggle" type="button" aria-expanded="false" aria-controls="<?php echo esc_attr( $list_id ); ?>" aria-label="<?php echo esc_attr__( 'Toggle table of contents', 'md-toc' ); ?>">
				<?php echo md_icon( 'angle-down', array( 'classes' => 'toc-trigger' ) ); ?>
			</button>

		</div>

		<ol id="<?php echo esc_attr( $list_id ); ?>" class="toc-list">

			<?php foreach ( $groups as $order => $fields ) : ?>

			<li class="toc-item toc-<?php echo esc_attr( $fields['tag'] ); ?>">

				<div class="toc-item-title">

					<a class="toc-item-label" href="#<?php echo esc_attr( $fields['id'] ); ?>"><?php echo esc_html( $fields['text'] ); ?></a>

					<?php if ( ! empty( $fields['children'] ) ) :
						$sublist_id = $toc_id . '_sublist_' . $order;
					?>

					<button class="toc-item-toggle" type="button" aria-expanded="false" aria-controls="<?php echo esc_attr( $sublist_id ); ?>" aria-label="<?php echo esc_attr__( 'Toggle section headings', 'md-toc' ); ?>">
						<?php echo md_icon( 'angle-down', array( 'classes' => 'toc-trigger' ) ); ?>
					</button>

					<?php endif; ?>

				</div>

				<?php if ( ! empty( $fields['children'] ) ) : ?>

				<ol id="<?php echo esc_attr( $sublist_id ); ?>" class="toc-sublist">

					<?php foreach ( $fields['children'] as $child ) : ?>

					<li class="toc-item toc-<?php echo esc_attr( $child['tag'] ); ?>">
						<div class="toc-item-title">
							<a class="toc-item-label" href="#<?php echo esc_attr( $child['id'] ); ?>"><?php echo esc_html( $child['text'] ); ?></a>
						</div>
					</li>

					<?php endforeach; ?>

				</ol>

				<?php endif; ?>

			</li>

			<?php endforeach; ?>

		</ol>

		<?php echo apply_filters( 'md_toc_html', '', $args, get_queried_object_id() ); ?>

	</div>

</nav>
