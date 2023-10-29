<?php
/**
 * Dropin Name: Table of Contents
 * Version: 1.0
 * Dropin URI: https://marketersdelight.com/dropins/table-of-contents/
 * Description: A smart and nimble table of contents for your articles.
 * Author: Alex, Kolakube
 * Author URI: https://kolakube.com/
 */

if ( ! defined( 'WPINC' ) ) die;

class md_table_of_contents extends md_api {

	/**
	 * Run all WP action hooks and filters.
	 *
	 * @since 1.0
	 */

	public function actions() {
		$this->name = __( 'Table of Contents', 'md-toc' );
		$this->headings = array( 'h2', 'h3', 'h4', 'h5', 'h6' );
		$this->design = new md_design;

		add_action( 'save_post', array( $this, 'save_headings' ), 10, 2 );
//		add_action( 'md_settings_content_single', array( $this, 'admin_page' ) );
		add_action( 'md_post_layout_content_options', array( $this, 'layout_fields' ) );
	}

	/**
	 * Run all WP action hooks and filters.
	 *
	 * @since 1.0
	 */

	public function register() {
		return array(
			'admin_page' => array(
				'fields' => array(
					'start_position' => array( 'type' => 'number' ),
					'headings' => array(
						'type' => 'checkbox',
						'options' => $this->headings
					),
					'style' => array(
						'type' => 'checkbox',
						'options' => array( 'numbers', 'hide_indent' )
					),
					'alignment' => array(
						'type' => 'select',
						'options' => array( 'left', 'right' )
					)
				)
			),
			'meta_box' => array(
				'name' => $this->name,
				'fields' => array(
					'start_position' => array( 'type' => 'number' ),
					'headings' => array(
						'type' => 'checkbox',
						'options' => $this->headings
					),
					'alignment' => array(
						'type' => 'select',
						'options' => array( 'left', 'right' )
					),
					'layout' => array(
						'type' => 'checkbox',
						'options' => array( 'remove' )
					)
				)
			)
		);
	}

	/**
	 * Hook to WP template_redirect to add, remove, and manipulate frontend templates.
	 *
	 * @since 1.0
	 */

	public function template() {
		if ( is_singular() && ! md_post_meta( array( 'table_of_contents', 'layout', 'remove' ) ) ) {
			$headings = md_post_meta( array( 'table_of_contents', 'list' ) );
			if ( ! empty( $headings ) ) {
				add_action( 'md_hook_before_the_content', array( $this, 'html' ) );
				add_action( 'wp_enqueue_scripts', array( $this, 'script' ) );
				add_filter( 'md_filter_content_box_classes', array( $this, 'content_box_classes' ) );
			}
		}
	}

	/**
	 * Load dynamic CSS file to MD's style.css build process.
	 *
	 * @since 1.0
	 */

	public function css( $templates ) {
		$templates['table-of-contents'] = md_css( 'dropins', 'table-of-contents/css', true );

		return $templates;
	}

	/**
	 * Load dynamic JS file to MD's scripts.js build process.
	 *
	 * @since 1.0
	 */

	public function js( $templates ) {
		$templates['table-of-contents'] = md_js( 'dropins', 'table-of-contents/js', true );

		return $templates;
	}

	/**
	 * Hook to WP template_redirect to add, remove, and manipulate frontend templates.
	 *
	 * @since 1.0
	 */

	public function script() {
		wp_add_inline_script( 'marketers-delight', "\tMD.tableOfContents();" );
	}

	/**
	 * Add onScroll JS to single onScroll in JS template.
	 *
	 * @since 1.0
	 */

	public function onscroll() { ?>
		<script>
			var toc = document.getElementById( 'table_of_contents' );
			if ( toc !== null ) {
				var tocHeight = toc.clientHeight,
					tocOffsetTop = toc.offsetTop + contentBoxOffsetTop;
				if ( pos > tocOffsetTop + tocHeight ) {
					MD.addClass( toc, 'sticky' );
					toc.style.height = tocHeight + 'px';
				}
				else
					MD.removeClass( toc, 'sticky' );
				if ( pos > content.clientHeight + contentBoxOffsetTop )
					MD.removeClass( toc, 'sticky' );
			}
		</script>
	<?php }

	/**
	 * Update MD post meta with Table of Contents data.
	 *
	 * @since 1.0
	 */

	public function save_headings( $post_id, $post ) {
		$post_meta = md_post_meta();
		$post_meta['table_of_contents']['list'] = $this->parse_headings( $post->post_content );

		update_post_meta( $post_id, 'marketers_delight', $post_meta );
	}

	/**
	 * Compile TOC to the bare essentials.
	 *
	 * @since 1.0
	 */

	public function parse_headings( $post_content ) {
		$table = array();
		$pattern = '/<h[2-6]*[^>]*>.*?<\/h[2-6]>/';
		$pattern_tags = '/<h[2-6]*[^>]*>/';
		preg_match_all( $pattern, $post_content, $headings );
		$headings = $headings[0];
		$parse_text = implode( '', $headings );
		preg_match_all( $pattern_tags, $parse_text, $tags );
		$tags = $tags[0];

		foreach ( $headings as $order => $heading ) {
			$tag = str_replace( array( '<', '>' ), '', $tags[$order] );
			$heading = strip_tags( $heading );
			$table[$order] = array(
				'tag' => $tag,
				'id' => str_replace( ' ', '_', $heading ),
				'text' => $heading
			);
		}

		return $table;
	}

	/**
	 * Run all WP action hooks and filters.
	 *
	 * @since 1.0
	 */

	public function admin_page() {
		$name = $this->name;
		$headings = $this->headings;
		$design = $this->design->values();
		$single = esc_html( $design['typography']['body']['line_height']['desktop'] );
		$options = array();

		foreach ( $headings as $heading )
			$options[$heading] = sprintf( __( "Heading %s", 'md-toc' ), str_replace( 'h', '', $heading ) );

		include( md_template( 'dropins', 'table-of-contents/admin-page', true ) );
	}

	/**
	 * Create meta box template fields.
	 *
	 * @since 1.0
	 */

	public function meta_box() {
		$headings = $this->headings;
		$design = $this->design->values();
		$single = esc_html( $design['typography']['body']['line_height']['desktop'] );
		$options = array();

		foreach ( $headings as $heading )
			$options[$heading] = sprintf( __( "Heading %s", 'md-toc' ), str_replace( 'h', '', $heading ) );

		include( md_template( 'dropins', 'table-of-contents/meta-box', true ) );
	}

	/**
	 * Add "Remove TOC checkbox" to MD Layout meta box settings.
	 *
	 * @since 1.0
	 */

	public function layout_fields() {
		$this->fields->field( 'layout', array(
			'type' => 'checkbox',
			'options' => array(
				'remove' => __( 'Remove <b><acronym title="Table of Contents">TOC</acronym></b>', 'md-toc' )
			)
		) );
	}

	/**
	 * Load template markup for TOC box.
	 *
	 * @since 1.0
	 */

	public function html() {
		$toc = md_setting( array( 'table_of_contents' ) );
		$show_headings = md_post_meta( array( 'table_of_contents', 'headings' ) );

		if ( empty( $show_headings ) )
			$show_headings = md_setting( array( 'table_of_contents', 'headings' ) );

		$style = md_setting( array( 'table_of_contents', 'style' ) );
		$html = ! empty( $style ) && ! empty( $style['numbers'] ) ? 'ol' : 'ul';
		$headings = md_post_meta( array( 'table_of_contents', 'list' ) );

		include( md_template( 'dropins', 'table-of-contents/table-of-contents', true ) );
	}

	/**
	 * Add custom class to content box.
	 *
	 * @since 1.0
	 */

	public function content_box_classes( $classes ) {
		$alignment = md_post_meta( array( 'table_of_contents', 'alignment' ) );

		if ( empty( $alignment ) )
			$alignment = md_setting( array( 'table_of_contents', 'alignment' ) );

		if ( ! empty( $alignment ) )
			$classes[] = esc_attr( "toc-$alignment" );

		$classes[] = md_has_sidebar() ? 'toc-fixed' : 'toc-full';

		return $classes;
	}

}

new md_table_of_contents;