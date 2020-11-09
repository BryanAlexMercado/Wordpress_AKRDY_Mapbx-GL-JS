<?php

/**
 * Class spacious_accordian_widget.
 */
class spacious_accordian_widget extends WP_Widget {

	/**
	 * Sets up a new Accordian widget instance.
	 *
	 * @since  2.1.5
	 * @access public
	 */
	public function __construct() {
		$widget_ops  = array(
			'classname'                   => 'tg_widget_accordian',
			'description'                 => esc_html__( 'Show a Accordian.', 'spacious' ),
			'customize_selective_refresh' => true,
		);
		$control_ops = array( 'width' => 200, 'height' => 250 );
		parent::__construct( false, $name = esc_html__( 'TG: Accordian', 'spacious' ), $widget_ops, $control_ops );
	}

	/**
	 * Outputs the content of the Accordian widget
	 *
	 * @since  2.1.5
	 * @access public
	 *
	 * @param  array $args     Arguments including 'before_title', 'after_title'
	 * @param  array $instance Settings for the current Accordian widget instance.
	 */
	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );

		$accordian_title = apply_filters( 'widget_title', isset( $instance['accordian_title'] ) ? $instance['accordian_title'] : '' );
		$accordian_desc  = apply_filters( 'widget_text', isset( $instance['accordian_desc'] ) ? $instance['accordian_desc'] : '' );
		$accordian_count = isset( $instance['accordian_count'] ) ? absint( $instance['accordian_count'] ) : 1;

		// Ready array for WPML plugin compatibility
		$accordian_item_heading_arr = array();
		$accordian_item_content_arr = array();

		for ( $i = 1; $i <= $accordian_count; $i++ ) {
			$accordian_item_heading_name = 'accordian_item_heading_' . $i;
			$accordian_item_content_name = 'accordian_item_content_' . $i;

			$accordian_item_heading = isset( $instance[ $accordian_item_heading_name ] ) ? $instance[ $accordian_item_heading_name ] : '';
			$accordian_item_content = isset( $instance[ $accordian_item_content_name ] ) ? $instance[ $accordian_item_content_name ] : '';

			array_push( $accordian_item_heading_arr, $accordian_item_heading );
			array_push( $accordian_item_content_arr, $accordian_item_content );

			// For WPML plugin compatibility
			if ( function_exists( 'icl_register_string' && ! empty( $accordian_item_heading ) ) ) {
				if ( ! empty( $accordian_item_heading ) ) {
					icl_register_string( 'Spacious Pro', 'TG: Accordian widget item heading ' . $this->id . ( $i - 1 ), $accordian_item_heading_arr[ $i - 1 ] );
					icl_register_string( 'Spacious Pro', 'TG: Accordian widget item content ' . $this->id . ( $i - 1 ), $accordian_item_content_arr[ $i - 1 ] );
				}
			}
		}

		echo $before_widget;

		if ( ! empty( $accordian_title ) ) {
			echo $before_title . esc_html( $accordian_title ) . $after_title;
		}
		?>
		<?php if ( ! empty( $accordian_desc ) ) { ?>
			<p class="widget-desc">
				<?php echo esc_textarea( $accordian_desc ); ?>
			</p>
		<?php } ?>

		<?php if ( ! empty( $accordian_item_heading_arr ) ) { ?>
			<div id="tg-accordion" class="tg-accordion">

				<?php
				for ( $i = 1; $i <= $accordian_count; $i++ ) :
					if ( ! empty( $accordian_item_heading_arr[ $i - 1 ] ) ) {
						if ( function_exists( 'icl_t' ) ) {
							$accordian_item_heading_arr[ $i - 1 ] = icl_t( 'Spacious Pro', 'TG: Accordian widget item heading ' . $this->id . ( $i - 1 ), $accordian_item_heading_arr[ $i - 1 ] );
							$accordian_item_content_arr[ $i - 1 ] = icl_t( 'Spacious Pro', 'TG: Accordian widget item content ' . $this->id . ( $i - 1 ), $accordian_item_content_arr[ $i - 1 ] );
						}
						?>
						<div class="accordian-item">
							<div class="accordian-header">
								<?php echo esc_html( $accordian_item_heading_arr[ $i - 1 ] ); ?>
								<i class="fa fa-angle-down" aria-hidden="true"></i>
							</div> <!-- /.accordian-header -->
							<div class="accordian-content"><?php echo esc_html( $accordian_item_content_arr[ $i - 1 ] ); ?></div>
						</div> <!-- /.accordian-item -->
					<?php } ?>
				<?php endfor; ?>

			</div> <!-- /#tg-accordion-wrapper -->
		<?php } ?>

		<?php echo $after_widget;
	}

	/**
	 * Updates settings for the Accordian widget instance.
	 *
	 * @since  2.1.5
	 * @access public
	 *
	 * @param array $new_instance
	 * @param array $old_instance
	 *
	 * @return array Updated settings to save.
	 */
	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['accordian_title'] = sanitize_text_field( $new_instance['accordian_title'] );

		if ( current_user_can( 'unfiltered_html' ) ) {
			$instance['accordian_desc'] = $new_instance['accordian_desc'];
		} else {
			$instance['accordian_desc'] = force_balance_tags( stripslashes( wp_filter_post_kses( addslashes( $new_instance['accordian_desc'] ) ) ) );
		}

		$instance['accordian_count'] = absint( $new_instance['accordian_count'] );
		$accordian_count             = $instance['accordian_count'];

		for ( $i = 1; $i <= $accordian_count; $i++ ) {
			$heading_field_name = 'accordian_item_heading_' . $i;
			$content_field_name = 'accordian_item_content_' . $i;

			$instance[ $heading_field_name ] = sanitize_text_field( $new_instance[ $heading_field_name ] );

			if ( current_user_can( 'unfiltered_html' ) ) {
				$instance[ $content_field_name ] = $new_instance[ $content_field_name ];
			} else {
				$instance[ $content_field_name ] = stripslashes( wp_filter_post_kses( addslashes( $new_instance[ $content_field_name ] ) ) );
			}
		}

		return $instance;
	}

	/**
	 * Outputs the settings form for the Accordian widget.
	 *
	 * @since  2.1.5
	 * @access public
	 *
	 * @param  array $instance Current settings.
	 */
	function form( $instance ) {
		$defaults = array(
			'accordian_title' => '',
			'accordian_desc'  => '',
			'accordian_count' => 1,
		);

		$accordian_count = isset( $instance['accordian_count'] ) ? absint( $instance['accordian_count'] ) : 1;

		for ( $i = 1; $i <= $accordian_count; $i++ ) {
			$heading_field_name = 'accordian_item_heading_' . $i;
			$content_field_name = 'accordian_item_content_' . $i;

			$defaults[ $heading_field_name ] = '';
			$defaults[ $content_field_name ] = '';
		}

		$instance               = wp_parse_args( (array) $instance, $defaults );
		?>
		<!-- Accordian title -->
		<p>
			<label for="<?php echo $this->get_field_id( 'accordian_title' ); ?>">
				<?php esc_html_e( 'Title:', 'spacious' ); ?>
			</label>
			<input type="text" name="<?php echo $this->get_field_name( 'accordian_title' ) ?>" id="<?php echo $this->get_field_id( 'accordian_title' ); ?>" value="<?php echo esc_html( $instance['accordian_title'] ); ?>" class="widefat" />
		</p>

		<!-- Accordian description -->
		<p>
			<label for="<?php echo $this->get_field_id( 'accordian_desc' ); ?>">
				<?php esc_html_e( 'Description:', 'spacious' ); ?>
			</label>
			<textarea rows="5" name="<?php echo $this->get_field_name( 'accordian_desc' ); ?>" id="<?php echo $this->get_field_id( 'accordian_desc' ) ?>" class="widefat"><?php echo esc_textarea( $instance['accordian_desc'] ); ?></textarea>
		</p>

		<!-- Number of accordian -->
		<p>
			<label for="<?php echo $this->get_field_id( 'accordian_count' ); ?>">
				<?php esc_html_e( 'Number of accordian to show:', 'spacious' ); ?>
			</label>
			<input type="number" min="1" name="<?php echo $this->get_field_name( 'accordian_count' ) ?>" id="<?php echo $this->get_field_id( 'accordian_count' ); ?>" value="<?php echo $accordian_count; ?>" class="widefat" />
		</p>

		<!-- Accordian -->
		<?php
		for ( $i = 1; $i <= $accordian_count; $i++ ) :
			$heading_field_name = 'accordian_item_heading_' . $i;
			$content_field_name = 'accordian_item_content_' . $i;
			?>
			<div class="tg-accordian-wrapper">
				<p>
					<label for="<?php echo $this->get_field_id( $heading_field_name ) ?>"><?php esc_html_e( 'Accordian heading:', 'spacious' ); ?></label>
					<input type="text" name="<?php echo $this->get_field_name( $heading_field_name ) ?>" id="<?php echo $this->get_field_id( $heading_field_name ); ?>" value="<?php echo esc_attr( $instance[ $heading_field_name ] ); ?>" class="widefat" />
				</p>
				<p>
					<label for="<?php echo $this->get_field_id( $content_field_name ) ?>"><?php esc_html_e( 'Accordian content:', 'spacious' ); ?></label>
					<textarea rows="5" name="<?php echo $this->get_field_name( $content_field_name ); ?>" id="<?php echo $this->get_field_id( $content_field_name ) ?>" class="widefat"><?php echo esc_textarea( $instance[ $content_field_name ] ); ?></textarea>
				</p>
			</div> <!-- /.accordian-wrapper -->
		<?php endfor; ?>

		<?php
	}
}
