<?php
/**
 * Create widget interface and frontend output.
 *
 * @since 2.0
 */

class md_table_of_contents_widget extends WP_Widget {

	/**
	 * Create widget attributes and fire any needed actions.
	 *
	 * @since 2.0
	 */

	public function __construct() {
		parent::__construct( 'md_table_of_contents_widget', __( 'MD &rarr; Table of Contents', 'md' ), array(
			'description' => __( 'Show a table of contents for the currently viewed post.', 'md' ),
			'customize_selective_refresh' => true
		) );
	}

	/**
	 * Frontend template with passed data.
	 *
	 * @since 2.0
	 */

	public function widget( $args, $val ) {
		if ( ! is_singular() )
            return;

        if ( ! empty( $val['title'] ) )
            $args['title'] = $val['title'];

        md_toc( $args );
	}

	/**
	 * Sanitize saved data.
	 *
	 * @since 2.0
	 */

	public function update( $new, $val ) {
        $val['title'] = esc_html( $new['title'] );
        /*
		$sanitize = new md_sanitize;
		$val['title'] = $sanitize->text( $new['title'] );
		$val['see_more'] = $sanitize->text( $new['see_more'] );
		$val['taxonomy'] = $sanitize->select( $new['taxonomy'], md_taxonomy_meta() );
		$val['posts_per_category'] = $sanitize->number( $new['posts_per_category'] );
		$val['direction'] = $sanitize->select( $new['direction'], array( 'DESC' ) );
		$val['order'] = $sanitize->select( $new['order'], array_keys( $this->terms_order ) );
		$val['exclude'] = esc_html( $new['exclude'] );
*/
		return $val;
	}

	/**
	 * Build widget form settings.
	 *
	 * @since 2.0
	 */

	public function form( $val ) {
		$val = wp_parse_args( (array) $val, array(
			'title' => ''
		) );
	?>

    <p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php echo __( 'Title', 'md' ); ?>:</label><br />
        <input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $val['title'] ); ?>" class="widefat" />
    </p>

	<?php }

}