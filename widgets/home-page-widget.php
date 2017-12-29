<?php
class Index_Of_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'index_of_widget',
			'Home Page Widget',
			'Index Of theme-specific Home Page Widget'
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		print '<tr>'  . PHP_EOL;

		if ( 'folder' === $instance['type'] ) {
			$image_url = esc_url( get_template_directory_uri() . '/images/folder.gif' );
		} else {
			$image_url = esc_url( get_template_directory_uri() . '/images/text.gif' );
		}
		if ( 'external' === $instance['target'] ) {
			$target = 'target="_blank"';
		} else {
			$target = '';
		}
		printf( '<td><img src="%s" alt="[DIR]" /> <a href="%s" %s rel="bookmark">%s</a></td>' . PHP_EOL,
			$image_url,
			esc_url( $instance['url'] ),
			$target,
			$instance['title']
		);
		printf( '<td>%s</td>' . PHP_EOL, $instance['description'] );

		print '</tr>' . PHP_EOL;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		$description = ! empty( $instance['description'] ) ? $instance['description'] : '';
		$url = ! empty( $instance['url'] ) ? $instance['url'] : '#';
		$type = ! empty( $instance['type'] ) ? $instance['type'] : 'file';
		$target = ! empty( $instance['target'] ) ? $instance['target'] : 'external';
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">Label</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>">Description</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>" type="text" value="<?php echo esc_attr( $description ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'url' ) ); ?>">URL</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'url' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'url' ) ); ?>" type="text" value="<?php echo esc_attr( $url ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'type' ) ); ?>">Type</label><br />

			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'type' ) ); ?>-folder" name="<?php echo esc_attr( $this->get_field_name( 'type' ) ); ?>" type="radio" value="folder" <?php checked( $type, 'folder', true ); ?>>Folder
			<br />
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'type' ) ); ?>-file" name="<?php echo esc_attr( $this->get_field_name( 'type' ) ); ?>" type="radio" value="file" <?php checked( $type, 'file', true ); ?>>File
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>">Target</label><br />

			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>-internal" name="<?php echo esc_attr( $this->get_field_name( 'target' ) ); ?>" type="radio" value="internal" <?php checked( $target, 'internal', true ); ?>>Internal
			<br />
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'target' ) ); ?>-external" name="<?php echo esc_attr( $this->get_field_name( 'target' ) ); ?>" type="radio" value="external" <?php checked( $target, 'external', true ); ?>>External (target="_blank")
		</p>
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();

		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['description'] = ( ! empty( $new_instance['description'] ) ) ? strip_tags( $new_instance['description'] ) : '';
		$instance['url'] = ( ! empty( $new_instance['url'] ) ) ? strip_tags( $new_instance['url'] ) : '';
		$instance['type'] = ( ! empty( $new_instance['type'] ) ) ? strip_tags( $new_instance['type'] ) : '';
		$instance['target'] = ( ! empty( $new_instance['target'] ) ) ? strip_tags( $new_instance['target'] ) : '';

		return $instance;
	}
}
add_action( 'widgets_init', function() {
	register_widget( 'Index_Of_Widget' );
} );
