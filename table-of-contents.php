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
	private $context = 'inline';
	private $position = 'gutter-left';
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
	}

	/**
	 * Run admin hooks and filters.
	 *
	 * @since 6.0
	 */

	private function admin_actions() {
		add_action( 'md_hook_layout_admin_single_fields', function( $fields ) {
			include md_template( 'dropins', "{$this->slug}/meta-box", true );
		} );

		add_filter( 'md_filter_save_layout_fields', function( $fields ) {
			$fields['toc'] = array(
				'type' => 'checkbox',
				'options' => array( 'add', 'sticky' )
			);
			$fields['toc_position'] = array(
				'type' => 'select',
				'options' => array( 'gutter-left', 'gutter-right', 'inline' )
			);
			return $fields;
		} );
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
		if ( is_singular() && ! empty( $this->headings ) )
			wp_add_inline_script( 'marketers-delight', "MD.tableOfContents();" );
	}

	/**
	 * Hook into the frontend template on singular posts that have headings.
	 *
	 * @since 1.0
	 */

	public function template() {
		$this->headings = md_post_meta( array( $this->id, 'list' ) );

		if ( ! is_singular() || empty( $this->headings ) )
			return;

		$enable = md_module( array( 'layout', 'toc', 'add' ) );

		if ( ! $enable )
			return;

		$positions = array( 'gutter-left', 'gutter-right', 'inline' );
		$position = md_module( array( 'layout', 'toc_position' ), 'gutter-left' );
		$this->position = in_array( $position, $positions, true ) ? $position : 'gutter-left';
		$can_use_gutter = ! md_has_sidebar() && ! md_has_builder();
		$this->context = $can_use_gutter && $this->position !== 'inline' ? 'gutter' : 'inline';

		add_action( 'md_hook_the_content_top', array( $this, 'render' ) );

		if ( $this->context === 'gutter' || $this->position === 'inline' )
			add_filter( 'md_filter_content_box_classes', array( $this, 'content_box_classes' ) );
	}

	/**
	 * Render the automatically placed Table of Contents.
	 *
	 * @since 2.0
	 */

	public function render() {
		md_toc( array(
			'context' => $this->context,
			'floating' => $this->context === 'inline',
			'title' => $this->context === 'gutter' ? __( 'On this page', 'md-toc' ) : $this->name
		) );
	}

	/**
	 * Add automatic TOC position details to the content box.
	 *
	 * @since 2.0
	 */

	public function content_box_classes( $classes ) {
		if ( $this->context === 'gutter' ) {
			$classes[] = 'has-toc-gutter';
			$classes[] = "toc-{$this->position}";
		}
		elseif ( $this->context === 'inline' )
			$classes[] = 'has-toc-float';

		return $classes;
	}

	/**
	 * Update MD post meta with Table of Contents data.
	 *
	 * @since 1.0
	 */

	public function save_post_meta( $meta, $post ) {
		$meta[$this->id]['list'] = $this->parse_headings( $post->post_content );

		return $meta;
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
