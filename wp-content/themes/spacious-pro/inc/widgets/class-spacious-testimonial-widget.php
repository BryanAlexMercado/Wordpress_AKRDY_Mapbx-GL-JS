<?php

/**
 * Class spacious_testimonial_widget.
 */
class spacious_testimonial_widget extends WP_Widget {

	function __construct() {
		$widget_ops  = array(
			'classname'                   => 'widget_testimonial',
			'description'                 => esc_html__( 'Display Testimonial', 'spacious' ),
			'customize_selective_refresh' => true,
		);
		$control_ops = array( 'width' => 200, 'height' => 250 );
		parent::__construct( false, $name = esc_html__( 'TG: Testimonial', 'spacious' ), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title           = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$text            = apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance );
		$name            = apply_filters( 'widget_name', empty( $instance['name'] ) ? '' : $instance['name'], $instance, $this->id_base );
		$byline          = apply_filters( 'widget_byline', empty( $instance['byline'] ) ? '' : $instance['byline'], $instance, $this->id_base );
		$slider_enable   = ! empty( $instance['slider_enable'] ) ? 'true' : 'false';
		$pauseOnHover    = ! empty( $instance['pauseOnHover'] ) ? 'true' : 'false';
		$slider_speed    = empty( $instance['slider_speed'] ) ? 1500 : $instance['slider_speed'];
		$slider_delay    = empty( $instance['slider_delay'] ) ? 4000 : $instance['slider_delay'];
		$slides_per_view = empty( $instance['slides_per_view'] ) ? 1 : $instance['slides_per_view'];

		if ( ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() ) && ( $slider_enable == 'true' ) ) {
			wp_enqueue_script( 'jquery_cycle' );
			wp_enqueue_script( 'jquery-swipe' );
			wp_enqueue_script( 'jquery-cycle2-carousel' );
		}

		// For WPML plugin compatibility
		if ( function_exists( 'icl_register_string' ) ) {
			icl_register_string( 'Spacious Pro', 'TG: Testimonial widget text' . $this->id, $text );
			icl_register_string( 'Spacious Pro', 'TG: Testimonial widget name' . $this->id, $name );
			icl_register_string( 'Spacious Pro', 'TG: Testimonial widget byline' . $this->id, $byline );
		}

		echo $before_widget;
		if ( ! empty( $title ) ) {
			echo $before_title . esc_html( $title ) . $after_title;
		} ?>

		<?php if ( $slider_enable == 'true' ) : ?>
			<div id="<?php echo esc_attr( $this->id ); ?>-cycle-prev" class="testimonial-cycle-prev"></div>
			<div id="<?php echo esc_attr( $this->id ); ?>-cycle-next" class="testimonial-cycle-next"></div>
		<?php endif; ?>

		<div class="testimonial-widget"
			<?php if ( $slider_enable == 'true' ) : ?>
				data-enable="<?php echo esc_attr( $slider_enable ); ?>"
				data-speed="<?php echo esc_attr( $slider_speed ); ?>" data-delay="<?php echo esc_attr( $slider_delay ); ?>"
				data-pauseOnHover="<?php echo esc_attr( $pauseOnHover ); ?>"
				data-slides_per_view="<?php echo esc_attr( $slides_per_view ); ?>" data-cycle-prev="#<?php echo esc_attr( $this->id ); ?>-cycle-prev"
				data-cycle-next="#<?php echo esc_attr( $this->id ); ?>-cycle-next"
			<?php endif; ?>
		>
			<?php
			$j = 1;
			$slides_class = '';
			for ( $count = 1; $count < 13; $count ++ ) :
				if ( $slides_per_view == '2' ) {
					if ( $j % 2 == 0 ) {
						$slides_class = 'tg-one-half tg-one-half-last clearfix';
					} else {
						$slides_class = 'tg-one-half';
					}
				} elseif ( $slides_per_view == '3' ) {
					if ( $j % 2 == 1 && $j > 1 ) {
						$slides_class = "tg-one-third";
					} elseif ( $j % 3 == 1 && $j > 1 ) {
						$slides_class = "tg-one-third tg-after-three-blocks-clearfix";
					} else {
						$slides_class = "tg-one-third";
					}
				}
				$id = ( $count != 1 ) ? $count : '';

				$text   = apply_filters( 'widget_text', empty( $instance[ 'text' . $id ] ) ? '' : $instance[ 'text' . $id ], $instance );
				$name   = apply_filters( 'widget_name', empty( $instance[ 'name' . $id ] ) ? '' : $instance[ 'name' . $id ], $instance, $this->id_base );
				$byline = apply_filters( 'widget_byline', empty( $instance[ 'byline' . $id ] ) ? '' : $instance[ 'byline' . $id ], $instance, $this->id_base );

				// For WPML plugin compatibility
				if ( function_exists( 'icl_register_string' ) ) {
					icl_register_string( 'Spacious Pro', 'TG: Testimonial widget text' . $id . $this->id, $text );
					icl_register_string( 'Spacious Pro', 'TG: Testimonial widget name' . $id . $this->id, $name );
					icl_register_string( 'Spacious Pro', 'TG: Testimonial widget byline' . $id . $this->id, $byline );
				}
				?>
				<?php if ( ! empty( $text ) ) { ?>
				<?php $slider_class = '';
				if ( $slider_enable == 'true' ) {
					$slider_class = 'slider-enable';
				} ?>
				<div
					class="testimonial-details <?php echo esc_attr( $slider_class ); ?> <?php echo esc_attr( $slides_class ); ?>">
					<div class="testimonial-icon"></div>
					<div class="testimonial-post"><?php
						// For WPML plugin compatibility
						if ( function_exists( 'icl_t' ) ) {
							$text = icl_t( 'Spacious Pro', 'TG: Testimonial widget text' . $id . $this->id, $text );
						}
						echo '<p>' . esc_textarea( $text ) . '</p>'; ?></div>
					<div class="testimonial-author">
								<span><?php
									// For WPML plugin compatibility
									if ( function_exists( 'icl_t' ) ) {
										$name = icl_t( 'Spacious Pro', 'TG: Testimonial widget name' . $id . $this->id, $name );
									}
									echo esc_html( $name ); ?></span>
						<?php
						// For WPML plugin compatibility
						if ( function_exists( 'icl_t' ) ) {
							$byline = icl_t( 'Spacious Pro', 'TG: Testimonial widget byline' . $id . $this->id, $byline );
						}
						echo esc_html( $byline ); ?>
					</div>
				</div>
			<?php } ?>
				<?php
				$j ++;
			endfor;
			?>
		</div>
		<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance                    = $old_instance;
		$instance['title']           = strip_tags( $new_instance['title'] );
		$instance['slider_enable']   = isset( $new_instance['slider_enable'] ) ? 1 : 0;
		$instance['pauseOnHover']    = isset( $new_instance['pauseOnHover'] ) ? 1 : 0;
		$instance['slider_speed']    = absint( $new_instance['slider_speed'] );
		$instance['slider_delay']    = absint( $new_instance['slider_delay'] );
		$instance['slides_per_view'] = absint( $new_instance['slides_per_view'] );

		for ( $count = 1; $count < 13; $count ++ ) {
			$id                         = ( $count != 1 ) ? $count : '';
			$instance[ 'name' . $id ]   = strip_tags( $new_instance[ 'name' . $id ] );
			$instance[ 'byline' . $id ] = strip_tags( $new_instance[ 'byline' . $id ] );
			if ( current_user_can( 'unfiltered_html' ) ) {
				$instance[ 'text' . $id ] = $new_instance[ 'text' . $id ];
			} else {
				$instance[ 'text' . $id ] = stripslashes( wp_filter_post_kses( addslashes( $new_instance[ 'text' . $id ] ) ) );
			} // wp_filter_post_kses() expects slashed
		}
		$instance['filter'] = isset( $new_instance['filter'] );

		return $instance;
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array(
			'title'  => '',
			'text'   => '',
			'name'   => '',
			'byline' => '',
		) );

		for ( $count = 1; $count < 13; $count ++ ) {
			$id = ( $count != 1 ) ? $count : '';

			$tg_defaults[ 'text' . $id ]   = '';
			$tg_defaults[ 'name' . $id ]   = '';
			$tg_defaults[ 'byline' . $id ] = '';
		}
		$tg_defaults['slider_enable']   = '0';
		$tg_defaults['slider_speed']    = 1500;
		$tg_defaults['slider_delay']    = 4000;
		$tg_defaults['slides_per_view'] = 1;
		$tg_defaults['pauseOnHover']    = '0';

		$instance = wp_parse_args( (array) $instance, $tg_defaults );

		$title           = strip_tags( $instance['title'] );
		$name            = strip_tags( $instance['name'] );
		$byline          = strip_tags( $instance['byline'] );
		$text            = esc_textarea( $instance['text'] );
		$slider_enable   = $instance['slider_enable'] ? 'checked="checked"' : '';
		$pauseOnHover    = $instance['pauseOnHover'] ? 'checked="checked"' : '';
		$slider_speed    = $instance['slider_speed'];
		$slider_delay    = $instance['slider_delay'];
		$slides_per_view = $instance['slides_per_view'];

		?>

		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'spacious' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>"
			       name="<?php echo $this->get_field_name( 'title' ); ?>" type="text"
			       value="<?php echo esc_attr( $title ); ?>"/>
		</p>
		<?php
		for ( $count = 1; $count < 13; $count ++ ) {
			$id     = ( $count != 1 ) ? $count : '';
			$name   = strip_tags( $instance[ 'name' . $id ] );
			$byline = strip_tags( $instance[ 'byline' . $id ] );
			$text   = esc_textarea( $instance[ 'text' . $id ] );
			?>
			<?php _e( 'Testimonial Description', 'spacious' );
			echo $id; ?>
			<textarea class="widefat" rows="8" cols="20" id="<?php echo $this->get_field_id( 'text' . $id ); ?>"
			          name="<?php echo $this->get_field_name( 'text' . $id ); ?>"><?php echo $text; ?></textarea>

			<p><label for="<?php echo $this->get_field_id( 'name' . $id ); ?>"><?php _e( 'Name:', 'spacious' );
					echo $id; ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'name' . $id ); ?>"
				       name="<?php echo $this->get_field_name( 'name' . $id ); ?>" type="text"
				       value="<?php echo esc_attr( $name ); ?>"/>
			</p>

			<p><label for="<?php echo $this->get_field_id( 'byline' . $id ); ?>"><?php _e( 'Byline:', 'spacious' );
					echo $id; ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( 'byline' . $id ); ?>"
				       name="<?php echo $this->get_field_name( 'byline' . $id ); ?>" type="text"
				       value="<?php echo esc_attr( $byline ); ?>"/>
			</p>

		<?php } ?>

		<p>
			<input class="checkbox" type="checkbox" <?php echo $slider_enable; ?>
			       id="<?php echo $this->get_field_id( 'slider_enable' ); ?>"
			       name="<?php echo $this->get_field_name( 'slider_enable' ); ?>"/>
			<label
				for="<?php echo $this->get_field_id( 'slider_enable' ); ?>"><?php esc_html_e( 'Enable slider', 'spacious' ); ?></label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php echo $pauseOnHover; ?>
			       id="<?php echo $this->get_field_id( 'pauseOnHover' ); ?>"
			       name="<?php echo $this->get_field_name( 'pauseOnHover' ); ?>"/>
			<label
				for="<?php echo $this->get_field_id( 'pauseOnHover' ); ?>"><?php esc_html_e( 'Enable Pause on Hover', 'spacious' ); ?></label>
		</p>
		<p>
			<label
				for="<?php echo $this->get_field_id( 'slider_speed' ); ?>"><?php esc_html_e( 'Transition Speed Time (in ms):', 'spacious' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'slider_speed' ); ?>"
			       name="<?php echo $this->get_field_name( 'slider_speed' ); ?>" type="text"
			       value="<?php echo esc_attr( $slider_speed ); ?>" size="3"/>
		</p>
		<p>
			<label
				for="<?php echo $this->get_field_id( 'slider_delay' ); ?>"><?php esc_html_e( 'Transition delay Time (in ms):', 'spacious' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'slider_delay' ); ?>"
			       name="<?php echo $this->get_field_name( 'slider_delay' ); ?>" type="text"
			       value="<?php echo esc_attr( $slider_delay ); ?>" size="3"/>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'slides_per_view' ); ?>"
			       class="widefat"><?php esc_html_e( 'Slides Per View:', 'spacious' ); ?></label>
			<select id="<?php echo $this->get_field_id( 'slides_per_view' ); ?>"
			        name="<?php echo $this->get_field_name( 'slides_per_view' ); ?>">
				<option
					value="1" <?php echo esc_attr( '1' == $slides_per_view ? 'selected="selected"' : '' ); ?> ><?php esc_html_e( 'one', 'spacious' ); ?></option>
				<option
					value="2" <?php echo esc_attr( '2' == $slides_per_view ? 'selected="selected"' : '' ); ?>><?php esc_html_e( 'two', 'spacious' ); ?></option>
				<option
					value="3" <?php echo esc_attr( '3' == $slides_per_view ? 'selected="selected"' : '' ); ?>><?php esc_html_e( 'three', 'spacious' ); ?></option>
			</select>
		</p>
		<?php
	}
}
