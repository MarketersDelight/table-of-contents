<?php
/**
 * Create widget interface and frontend output.
 *
 * @since 2.0
 */

class md_table_of_contents_widget extends WP_Widget {

	private $table_of_contents;

	/**
	 * Create widget attributes and fire any needed actions.
	 *
	 * @since 2.0
	 */

	public function __construct( $table_of_contents ) {
		$this->table_of_contents = $table_of_contents;

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

		$render = array(
			'context' => 'widget',
			'before' => $args['before_widget'],
			'after' => $args['after_widget']
		);

		if ( ! empty( $val['title'] ) )
			$render['title'] = $val['title'];

		$this->table_of_contents->html( $render );
	}

	/**
	 * Sanitize saved data.
	 *
	 * @since 2.0
	 */

	public function update( $new, $val ) {
		$val['title'] = sanitize_text_field( $new['title'] );

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
