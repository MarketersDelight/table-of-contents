<?php
/**
 * Drop-in Name: Table of Contents
 * Description: An auto-generated table of contents for your articles with deep layout integration and powerful functionality.
 * Author: Alex, Kolakube
 * Author URI: https://marketersdelight.com/
 * Drop-in URI: https://marketersdelight.com/dropins/table-of-contents/
 * Drop-in Slug: table-of-contents
 * Text Domain: md-toc
 * Version: 2.0
 * Requires at least: 6.6
 * Requires PHP: 7.4
 */

class md_table_of_contents extends md_api {

	public $id;
	public $name;
	private $headings;
	private $context = 'inline';
	private $position = 'inline';
	private $rendered = false;
	public $slug = 'table-of-contents';

	/**
	 * Run all WP action hooks and filters.
	 *
	 * @since 1.0
	 */

	public function actions() {
		$this->name = __( 'Table of Contents', 'md-toc' );
		$this->id = str_replace( '-', '_', $this->slug );

		add_action( 'md_hook_layout_after_toggles', array( $this, 'layout_fields' ), 10, 2 );

		add_filter( 'md_filter_save_layout_fields', function( $fields ) {
			$fields['toc'] = array(
				'type' => 'checkbox',
				'options' => array( 'add', 'remove', 'sticky' )
			);
			$fields['toc_position'] = array(
				'type' => 'select',
				'options' => array( 'inline', 'gutter-left', 'gutter-right' )
			);
			return $fields;
		} );
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
	 * Prepare Table of Contents fields for global and single Layout screens.
	 *
	 * @since 2.0
	 */

	public function layout_fields( $fields, $context ) {
		if ( ! $context['is_post'] && ! $context['is_admin'] )
			return;

		$invert = false;
		$toggle = 'add';
		$toggle_label = __( 'Add <b>Table of Contents</b>', 'md-toc' );
		$sticky_label = __( 'Make sticky', 'md-toc' );
		$position_options = $this->position_options();
		$position_label = __( 'Top of post', 'md-toc' );

		if ( $context['is_post'] ) {
			$global_add = md_post_type_field( array( 'layout', 'toc', 'add' ), null, $context['post_type'] );
			$global_sticky = md_post_type_field( array( 'layout', 'toc', 'sticky' ), null, $context['post_type'] );
			$sticky_label = $global_sticky ? __( 'Disable sticky', 'md-toc' ) : $sticky_label;

			if ( $global_add ) {
				$toggle = 'remove';
				$toggle_label = __( 'Remove <b>Table of Contents</b>', 'md-toc' );
				$invert = true;
			}
		}
		elseif ( ! md_post_type_settings_parent( $context['post_type'] ) )
			unset( $position_options['inline'] );

		$toggle_value = $fields->module( array( 'toc', $toggle ) );
		$show_options = $invert ? ! $toggle_value : $toggle_value;

		include md_template( 'dropins', "{$this->slug}/fields", true );
	}

	/**
	 * Available automatic placement options.
	 *
	 * @since 2.0
	 */

	private function position_options() {
		return array(
			'inline' => __( 'Top of post', 'md-toc' ),
			'gutter-left' => __( 'Left gutter', 'md-toc' ),
			'gutter-right' => __( 'Right gutter', 'md-toc' )
		);
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

		register_widget( new md_table_of_contents_widget( $this ) );
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
	 * Hook into the frontend template on singular posts that have headings.
	 *
	 * @since 1.0
	 */

	public function template() {
		if ( ! is_singular() )
			return;

		if ( empty( $this->headings() ) )
			return;

		$enable = md_module( array( 'layout', 'toc', 'add' ) ) && ! md_module( array( 'layout', 'toc', 'remove' ) );

		if ( ! $enable )
			return;

		$positions = array_keys( $this->position_options() );
		$position = md_module( array( 'layout', 'toc_position' ), 'inline' );
		$in_gutter = ! md_has_sidebar() && ! md_has_builder();

		$this->position = in_array( $position, $positions, true ) ? $position : 'inline';
		$this->context = $in_gutter && $this->position !== 'inline' ? 'gutter' : 'inline';

		add_action( 'md_hook_the_content_top', function() {
			$this->html( array(
				'context' => $this->context,
				'floating' => $this->context === 'inline',
				'title' => $this->context === 'gutter' ? __( 'On this page', 'md-toc' ) : $this->name
			) );
		} );

		if ( $this->context === 'gutter' || $this->position === 'inline' )
			add_filter( 'md_filter_content_box_classes', array( $this, 'content_box_classes' ) );
	}

	/**
	 * Get saved and template-added headings for the current page.
	 *
	 * @since 2.0
	 */

	private function headings() {
		if ( isset( $this->headings ) )
			return $this->headings;

		$post_id = get_queried_object_id();
		$headings = md_post_meta( array( $this->id, 'list' ), $post_id, array() );

		$this->headings = apply_filters( 'md_toc_headings', $headings, $post_id );

		return $this->headings;
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

	/**
	 * Print the Table of Contents HTML.
	 *
	 * @since 2.0
	 */

	public function html( $args = array() ) {
		$args = wp_parse_args( $args, array(
			'before' => '',
			'after' => '',
			'context' => 'inline',
			'floating' => false,
			'title' => __( 'Table of Contents', 'md-toc' )
		) );
		$contexts = array( 'widget', 'inline', 'gutter' );
		$context = in_array( $args['context'], $contexts, true ) ? $args['context'] : 'inline';
		$classes = array( 'toc', "toc-$context" );

		if ( $context === 'widget' && md_module( array( 'layout', 'toc', 'add' ) ) )
			return;

		if ( $context === 'widget' || md_get_layout_toggle( array( 'toc', 'sticky' ) ) )
			$classes[] = 'toc-sticky';

		if ( $context === 'inline' && $args['floating'] )
			$classes[] = 'toc-float';

		$classes = join( ' ', $classes );
		$headings = $this->headings();

		if ( empty( $headings ) )
			return;

		if ( $this->rendered )
			return;

		$this->rendered = true;

		$current = null;
		$groups = array();

		foreach ( $headings as $fields ) {
			if ( $fields['tag'] === 'h2' ) {
				$fields['children'] = array();
				$groups[] = $fields;
				$current = count( $groups ) - 1;
			}
			else {
				if ( $current !== null )
					$groups[$current]['children'][] = $fields;
				else {
					$fields['children'] = array();
					$groups[] = $fields;
				}
			}
		}

		$toc_id = 'table_of_contents';
		$title_id = $toc_id . '_title';
		$list_id = $toc_id . '_list';

		echo $args['before'];

		include md_template( 'dropins', 'table-of-contents/html', true );

		echo $args['after'];
	}

}

new md_table_of_contents;
