<?php

/**
 * Class spacious_call_to_action_widget.
 */
class spacious_call_to_action_widget extends WP_Widget {
	function __construct() {
		$widget_ops  = array(
			'classname'                   => 'widget_call_to_action',
			'description'                 => esc_html__( 'Use this widget to show the call to action section.', 'spacious' ),
			'customize_selective_refresh' => true,
		);
		$control_ops = array( 'width' => 200, 'height' => 250 );
		parent::__construct( false, $name = esc_html__( 'TG: Call To Action Widget', 'spacious' ), $widget_ops, $control_ops );
	}

	function form( $instance ) {
		$spacious_defaults['text_main']       = '';
		$spacious_defaults['text_additional'] = '';
		$spacious_defaults['button_text']     = '';
		$spacious_defaults['button_url']      = '';
		$spacious_defaults['new_tab']         = '0';
		$spacious_defaults['layout']          = 1;
		$spacious_defaults['image']           = '';

		$instance = wp_parse_args( (array) $instance, $spacious_defaults );

		$text_main       = $instance['text_main'];
		$text_additional = $instance['text_additional'];
		$button_text     = $instance['button_text'];
		$button_url      = $instance['button_url'];
		$new_tab         = $instance['new_tab'] ? 'checked="checked"' : '';
		$layout          = absint( $instance['layout'] );
		$image           = ! empty( $instance['image'] ) ? $instance['image'] : '';
		?>


		<!-- Main Text -->
		<p>
			<?php esc_html_e( 'Call to Action Main Text', 'spacious' ); ?>
			<textarea class="widefat" rows="3" cols="20" id="<?php echo $this->get_field_id( 'text_main' ); ?>" name="<?php echo $this->get_field_name( 'text_main' ); ?>"><?php echo esc_textarea( $text_main ); ?></textarea>
		</p>
		<!-- Additional Text -->
		<p>
			<?php esc_html_e( 'Call to Action Additional Text', 'spacious' ); ?>
			<textarea class="widefat" rows="3" cols="20" id="<?php echo $this->get_field_id( 'text_additional' ); ?>" name="<?php echo $this->get_field_name( 'text_additional' ); ?>"><?php echo esc_textarea( $text_additional ); ?></textarea>
		</p>
		<!-- Button Text -->
		<p>
			<label for="<?php echo $this->get_field_id( 'button_text' ); ?>"><?php esc_html_e( 'Button Text:', 'spacious' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'button_text' ); ?>" name="<?php echo $this->get_field_name( 'button_text' ); ?>" type="text" value="<?php echo esc_attr( $button_text ); ?>" />
		</p>
		<!-- Button Redirect Link -->
		<p>
			<label for="<?php echo $this->get_field_id( 'button_url' ); ?>"><?php esc_html_e( 'Button Redirect Link:', 'spacious' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'button_url' ); ?>" name="<?php echo $this->get_field_name( 'button_url' ); ?>" type="text" value="<?php echo esc_url( $button_url ); ?>" />
		</p>
		<!-- Open in new tab -->
		<p>
			<input class="checkbox" type="checkbox" <?php echo esc_attr( $new_tab ); ?> id="<?php echo $this->get_field_id( 'new_tab' ); ?>" name="<?php echo $this->get_field_name( 'new_tab' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'new_tab' ); ?>"><?php esc_html_e( 'Open in new tab', 'spacious' ); ?></label>
		</p>
		<!-- Background image -->
		<p>
			<label for="<?php echo $this->get_field_id( 'image' ); ?>"><?php esc_html_e( 'Image:', 'spacious' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" type="text" value="<?php echo esc_url( $image ); ?>" />
			<button class="upload_image_button button button-primary"><?php esc_html_e( 'Upload Image', 'spacious' ) ?></button>
		</p>
		<!-- Call to action styles -->
		<p>
			<label for="<?php echo $this->get_field_id( 'layout' ); ?>"><?php esc_html_e( 'Choose style:', 'spacious' ); ?></label><br />
			<input id="<?php echo $this->get_field_id( 'layout' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'layout' ); ?>" type="radio" <?php checked( $layout, 1 ) ?> value="1" /><?php esc_html_e( 'Style One', 'spacious' ); ?>
			<input id="<?php echo $this->get_field_id( 'layout' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'layout' ); ?>" type="radio" <?php checked( $layout, 2 ) ?> value="2" /><?php esc_html_e( 'Style Two', 'spacious' ); ?>
			<input id="<?php echo $this->get_field_id( 'layout' ); ?>" class="widefat" name="<?php echo $this->get_field_name( 'layout' ); ?>" type="radio" <?php checked( $layout, 3 ) ?> value="3" /><?php esc_html_e( 'Style Three', 'spacious' ); ?>
		</p>
		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		if ( current_user_can( 'unfiltered_html' ) ) {
			$instance['text_main'] = $new_instance['text_main'];
		} else {
			$instance['text_main'] = stripslashes( wp_filter_post_kses( addslashes( $new_instance['text_main'] ) ) );
		} // wp_filter_post_kses() expects slashed

		if ( current_user_can( 'unfiltered_html' ) ) {
			$instance['text_additional'] = $new_instance['text_additional'];
		} else {
			$instance['text_additional'] = stripslashes( wp_filter_post_kses( addslashes( $new_instance['text_additional'] ) ) );
		} // wp_filter_post_kses() expects slashed

		$instance['button_text'] = strip_tags( $new_instance['button_text'] );
		$instance['button_url']  = esc_url_raw( $new_instance['button_url'] );
		$instance['new_tab']     = isset( $new_instance['new_tab'] ) ? 1 : 0;
		$instance['layout']      = absint( $new_instance['layout'] );
		$instance['image']       = ! empty( $new_instance['image'] ) ? esc_url_raw( $new_instance['image'] ) : '';

		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );

		global $post;
		$new_tab         = ! empty( $instance['new_tab'] ) ? 'true' : 'false';
		$text_main       = empty( $instance['text_main'] ) ? '' : $instance['text_main'];
		$text_additional = empty( $instance['text_additional'] ) ? '' : $instance['text_additional'];
		$button_text     = isset( $instance['button_text'] ) ? $instance['button_text'] : '';
		$button_url      = isset( $instance['button_url'] ) ? $instance['button_url'] : '#';
		$layout          = ! empty( $instance['layout'] ) ? $instance['layout'] : 1;
		$image           = ! empty( $instance['image'] ) ? $instance['image'] : '';


		// For WPML plugin compatibility
		if ( function_exists( 'icl_register_string' ) ) {
			icl_register_string( 'Spacious Pro', 'TG: Call to Action widget main text' . $this->id, $text_main );
			icl_register_string( 'Spacious Pro', 'TG: Call to Action widget additional text' . $this->id, $text_additional );
			icl_register_string( 'Spacious Pro', 'TG: Call to Action widget button text' . $this->id, $button_text );
			icl_register_string( 'Spacious Pro', 'TG: Call to Action widget redirect link' . $this->id, $button_url );
		}

		echo $before_widget;
		?>
		<div class="call-to-action-content-wrapper call-to-action-layout-<?php echo esc_attr( $layout ); ?> clearfix" style="<?php echo ! empty( $image ) ? 'background-image: url(' . esc_url( $image ) . ')' : ''; ?>">
			<div class="call-to-action-content">
				<?php if ( ! empty( $text_main ) ) { ?>
					<h3>
						<?php
						// For WPML plugin compatibility
						if ( function_exists( 'icl_t' ) ) {
							$text_main = icl_t( 'Spacious Pro', 'TG: Call to Action widget main text' . $this->id, $text_main );
						}

						echo esc_html( $text_main );
						?>
					</h3>
				<?php }

				if ( ! empty( $text_additional ) ) { ?>
					<p>
						<?php
						// For WPML plugin compatibility
						if ( function_exists( 'icl_t' ) ) {
							$text_additional = icl_t( 'Spacious Pro', 'TG: Call to Action widget additional text' . $this->id, $text_additional );
						}
						echo esc_html( $text_additional );
						?>
					</p>
					<?php
				}
				?>
			</div>
			<?php if ( ! empty( $button_text ) ) { ?>
				<?php
				// For WPML plugin compatibility
				if ( function_exists( 'icl_t' ) ) {
					$button_text = icl_t( 'Spacious Pro', 'TG: Call to Action widget button text' . $this->id, $button_text );
					$button_url  = icl_t( 'Spacious Pro', 'TG: Call to Action widget redirect link' . $this->id, $button_url );
				}
				?>
				<a class="call-to-action-button" <?php if ( $new_tab == 'true' ) {
					echo 'target="_blank"';
				} ?> href="<?php echo $button_url; ?>" title="<?php echo esc_attr( $button_text ); ?>"><?php echo esc_html( $button_text ); ?></a>
				<?php
			}
			?>
		</div>
		<?php
		echo $after_widget;
	}
}
