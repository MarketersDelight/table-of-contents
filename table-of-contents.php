<?php
/**
 * Dropin Name: Table of Contents
 * Version: 2.0
 * Dropin URI: https://marketersdelight.com/dropins/table-of-contents/
 * Description: An auto-generated table of contents for your articles with deep layout integration and powerful functionality.
 * Author: Alex, Kolakube
 * Author URI: https://kolakube.com/
 */

class md_table_of_contents extends md_api {

	/**
	 * Define properties
	 */

	public $id;
	public $name;
	private $headings;
	public $slug = 'table-of-contents';

	/**
	 * Include additional files.
	 *
	 * @since 2.0
	 */

	public function includes() {
		require_once 'functions.php';
	}

	/**
	 * Run all WP action hooks and filters.
	 *
	 * @since 1.0
	 */

	public function actions() {
		$this->name = __( 'Table of Contents', 'md-toc' );
		$this->id = str_replace( '-', '_', $this->slug );

		$this->admin_actions();

		add_filter( 'md_filter_sticky_elements', function( $elements ) {
			$elements[] = '#table_of_contents';

			return $elements;
		} );
	}

	/**
	 * Run admin hooks and filters.
	 *
	 * @since 6.0
	 */

	private function admin_actions() {
		add_action( 'save_post', array( $this, 'save_headings' ), 10, 2 );

		add_action( 'md_hook_layout_admin_single_fields', function( $fields ) {
			include md_template( 'dropins', "{$this->slug}/meta-box", true );
		} );

		add_filter( 'md_filter_save_layout_fields', function( $fields ) {
			$fields['toc'] = array(
				'type' => 'checkbox',
				'options' => array( 'add', 'sticky' )
			);
			$fields['toc_align'] = array(
				'type' => 'select',
				'options' => array( 'left', 'right' )
			);
			return $fields;
		});
	}

	/**
	 * Load dynamic CSS file to MD's style.css build process.
	 *
	 * @since 1.0
	 */

	public function css( $css ) {
		$css[$this->slug] = md_css( 'dropins', "$this->slug/css", true );

		return $css;
	}

	/**
	 * Load dynamic JS file to MD's scripts.js build process.
	 *
	 * @since 1.0
	 */

	public function js( $js ) {
		$js[$this->slug] = md_js( 'dropins', "$this->slug/js/js", true );

		return $js;
	}

	/**
	 * Load TOC scrolling behaviors to MDJS onScroll event.
	 *
	 * @since 2.0
	 */

	public function onscroll() {
		include md_js( 'dropins', "$this->slug/js/onscroll", true );
	}

	/**
	 * Register and create widget.
	 *
	 * @since 2.0
	 */

	public function widgets() {
		require_once 'widget.php';
		register_widget( 'md_table_of_contents_widget' );
	}

	/**
	 * Enqueue inline script to initialise the TOC module.
	 *
	 * @since 1.0
	 */

	public function enqueue() {
		wp_add_inline_script( 'marketers-delight', "MD.tableOfContents();" );
	}

	/**
	 * Hook into the frontend template on singular posts that have headings.
	 *
	 * @since 1.0
	 */

	public function template() {
		$this->headings = md_post_meta( array( $this->id, 'list' ) );
		$enable = md_post_type_field( array( 'layout', 'toc', 'add' ) );

		if ( is_singular() && $enable && ! empty( $this->headings ) ) {
			add_action( 'md_hook_the_content_top', 'md_toc' );
		}
	}

	/**
	 * Update MD post meta with Table of Contents data.
	 *
	 * @since 1.0
	 */

	public function save_headings( $post_id, $post ) {
		$post_meta = md_post_meta();
		$post_meta[$this->id]['list'] = $this->parse_headings( $post->post_content );

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
			preg_match( '/h[2-6]/', $tags[$order], $match );
			$heading = strip_tags( $heading );
			$table[$order] = array(
				'tag' => $match[0],
				'id' => sanitize_title( $heading ),
				'text' => $heading
			);
		}

		return $table;
	}

}

new md_table_of_contents;