<?php

/**
 * Class spacious_fun_facts_widget.
 */
class spacious_fun_facts_widget extends WP_Widget {

	function __construct() {
		$widget_ops  = array(
			'classname'   => 'widget_fun_facts',
			'description' => esc_html__( 'Widget to show Fun Facts', 'spacious' ),
		);
		$control_ops = array( 'width' => 200, 'height' => 250 );
		parent::__construct( false, $name = esc_html__( 'TG: Fun Facts', 'spacious' ), $widget_ops, $control_ops );
	}

	function form( $instance ) {
		$background_color_value = ( spacious_options( 'spacious_color_skin', 'light' ) == 'light' ) ? '#f9f9f9' : '#3e3e3e';

		$instance = wp_parse_args( (array) $instance, array(
			'facts_title'      => '',
			'facts_desc'       => '',
			'fact_num-1'       => '',
			'fact_num-2'       => '',
			'fact_num-3'       => '',
			'fact_num-4'       => '',
			'fact-1'           => '',
			'fact-2'           => '',
			'fact-3'           => '',
			'fact-4'           => '',
			'icon-1'           => '',
			'icon-2'           => '',
			'icon-3'           => '',
			'icon-4'           => '',
			'column'           => '4',
			'background_color' => $background_color_value,
		) );

		$instance['facts_title'] = sanitize_text_field( $instance['facts_title'] );
		$instance['facts_desc']  = sanitize_text_field( $instance['facts_desc'] );
		$column                  = isset ( $instance['column'] ) ? $instance['column'] : 4;
		$background_color        = esc_attr( $instance['background_color'] );

		for ( $i = 1; $i <= 4; $i ++ ) {
			$fact_num              = 'fact_num-' . $i;
			$fact                  = 'fact-' . $i;
			$icon                  = 'icon-' . $i;
			$instance[ $fact_num ] = absint( $instance[ $fact_num ] );
			$instance[ $fact ]     = sanitize_text_field( $instance[ $fact ] );
			$instance[ $icon ]     = esc_attr( $instance[ $icon ] );
		} ?>

		<p>
			<label
				for="<?php echo $this->get_field_id( 'facts_title' ); ?>"><?php _e( 'Title:', 'spacious' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'facts_title' ); ?>"
			       name="<?php echo $this->get_field_name( 'facts_title' ); ?>" type="text"
			       value="<?php echo $instance['facts_title']; ?>"/>
		</p>

		<?php _e( 'Description:', 'spacious' ); ?>
		<textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id( 'facts_desc' ); ?>"
		          name="<?php echo $this->get_field_name( 'facts_desc' ); ?>"><?php echo $instance['facts_desc']; ?></textarea>

		<?php for ( $i = 1; $i <= $column; $i ++ ) {
			$fact_num = 'fact_num-' . $i;
			$fact     = 'fact-' . $i;
			$icon     = 'icon-' . $i;
			?>
			<p>
				<label for="<?php echo $this->get_field_id( $fact_num ); ?>"><?php _e( 'Fact number: ', 'spacious' );
					echo $i; ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( $fact_num ); ?>"
				       name="<?php echo $this->get_field_name( $fact_num ); ?>" type="text"
				       value="<?php echo $instance[ $fact_num ]; ?>"/>
			</p>

			<p>
				<label
					for="<?php echo $this->get_field_id( $fact ); ?>"><?php _e( 'Fact Detail:', 'spacious' ); ?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( $fact ); ?>"
				       name="<?php echo $this->get_field_name( $fact ); ?>" type="text"
				       value="<?php echo $instance[ $fact ]; ?>"/>
			</p>
			<p>
				<label
					for="<?php echo $this->get_field_id( $icon ); ?>"><?php _e( 'Icon Class:', 'spacious' ); ?></label>
				<input id="<?php echo $this->get_field_id( $icon ); ?>"
				       name="<?php echo $this->get_field_name( $icon ); ?>" placeholder="fa-trophy" type="text"
				       value="<?php echo $instance[ $icon ]; ?>"/>
			</p>
			<hr/>
		<?php } ?>

		<p>
			<?php
			$url  = 'http://fontawesome.io/icons/';
			$link = sprintf( __( '<a href="%s" target="_blank">Refer here</a> For Icon Class', 'spacious' ), esc_url( $url ) );
			echo $link;
			?>
		</p>
		<p>
			<label
				for="<?php echo $this->get_field_id( 'background_color' ); ?>"><?php esc_html_e( 'Background Color:', 'spacious' ); ?></label><br/>
			<input id="<?php echo $this->get_field_id( 'background_color' ); ?>" class="widefat tg-color-picker"
			       name="<?php echo $this->get_field_name( 'background_color' ); ?>" type="text"
			       value="<?php echo esc_attr( $instance['background_color'] ); ?>"
			       data-default-color="<?php echo esc_attr( $background_color_value ); ?>"/>
		</p>
		<?php esc_html_e( 'Select the column', 'spacious' ); ?>
		<p>
			<select id="<?php echo $this->get_field_id( 'column' ); ?>"
			        name="<?php echo $this->get_field_name( 'column' ); ?>">
				<option value="3" <?php if ( $column == '3' ) {
					echo 'selected="selected"';
				} ?> ><?php esc_html_e( 'Three Column', 'spacious' ); ?></option>
				<option value="4" <?php if ( $column == '4' ) {
					echo 'selected="selected"';
				} ?> ><?php esc_html_e( 'Four Column', 'spacious' ); ?></option>
			</select>
		</p>
		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['facts_title']      = sanitize_text_field( $new_instance['facts_title'] );
		$instance['column']           = $new_instance['column'];
		$instance['background_color'] = strtolower( $new_instance['background_color'] );

		if ( current_user_can( 'unfiltered_html' ) ) {
			$instance['facts_desc'] = $new_instance['facts_desc'];
		} else {
			$instance['facts_desc'] = stripslashes( wp_filter_post_kses( addslashes( $new_instance['facts_desc'] ) ) ); // wp_filter_post_kses() expects slashed
		}

		for ( $i = 1; $i <= 4; $i ++ ) {
			$fact_num              = 'fact_num-' . $i;
			$fact                  = 'fact-' . $i;
			$icon                  = 'icon-' . $i;
			$instance[ $fact_num ] = absint( $new_instance[ $fact_num ] );
			$instance[ $fact ]     = sanitize_text_field( $new_instance[ $fact ] );
			$instance[ $icon ]     = sanitize_text_field( $new_instance[ $icon ] );
		}

		return $instance;
	}

	function widget( $args, $instance ) {
		if ( is_active_widget( false, false, $this->id_base ) || is_customize_preview() ) {
			wp_enqueue_script( 'jquery-waypoints' );
			wp_enqueue_script( 'jquery-counterup' );
		}
		extract( $args );
		extract( $instance );
		$facts_title            = apply_filters( 'widget_title', isset( $instance['facts_title'] ) ? $instance['facts_title'] : '' );
		$facts_desc             = apply_filters( 'widget_text', empty( $instance['facts_desc'] ) ? '' : $instance['facts_desc'], $instance );
		$column                 = isset( $instance['column'] ) ? $instance['column'] : '4';
		$column_loop            = ( $column == '3' ) ? 3 : 4;
		$background_color_value = ( spacious_options( 'spacious_color_skin', 'light' ) == 'light' ) ? '#f9f9f9' : '#3e3e3e';
		$background_color        = isset( $instance['background_color'] ) ? $instance['background_color'] : $background_color_value;

		echo $before_widget; ?>

		<div class="section-wrapper">
			<div class="tg-container fact clearfix">
				<?php if ( $background_color != $background_color_value ) : ?>
					<style type="text/css">
						<?php
						echo '#' . $this->id;
						echo ', #' . $this->id . '::before';
						echo ', #' . $this->id . '::after';
						?>
						{
							background:
						<?php echo esc_attr( $background_color ); ?>
						}
					</style>
				<?php endif; ?>
				<?php if ( ! empty( $facts_title ) ) {
					echo $before_title . esc_html( $facts_title ) . $after_title;
				}
				if ( ! empty( $facts_desc ) ) { ?>
					<p class="widget-desc"><?php echo esc_textarea( $facts_desc ); ?></p>
				<?php } ?>

				<div class="counter-wrapper <?php echo ( $column == '3' ) ? 'clearfix' : ''; ?>">
					<?php
					for ( $i = 1; $i <= $column_loop; $i ++ ) {
						$fun_fact_class = '';
						if ( $column == '3' ) {
							if ( $i % 3 == 0 ) {
								$fun_fact_class = "tg-one-third tg-one-third-last fun-fact";
							} else {
								$fun_fact_class = "tg-one-third fun-fact";
							}
						} elseif ( $column == '4' ) {
							if ( $i % 4 == 0 ) {
								$class = 'tg-one-fourth tg-one-fourth-last fun-fact';
							} else {
								$fclass = 'tg-one-fourth fun-fact';
							}
						}

						$fact_num = 'fact_num-' . $i;
						$fact     = 'fact-' . $i;
						$icon     = 'icon-' . $i;

						$fact_num = isset( $instance[ $fact_num ] ) ? $instance[ $fact_num ] : '';
						$fact     = isset( $instance[ $fact ] ) ? $instance[ $fact ] : '';
						$icon     = isset( $instance[ $icon ] ) ? $instance[ $icon ] : '';

						// For Multilingual compatibility
						if ( ! empty( $fact ) ) {
							if ( function_exists( 'icl_register_string' ) ) {
								icl_register_string( 'Spacious Pro', 'TG: Fun Facts' . $this->id . $i, $fact );
							}

							if ( function_exists( 'icl_t' ) ) {
								$fact = icl_t( 'Spacious Pro', 'TG: Fun Facts' . $this->id . $i, $fact );
							}
						}

						if ( isset( $fact_num ) ) : ?>
							<div
								class="counter-block-wrapper <?php echo esc_attr( $fun_fact_class ); ?>  <?php echo ( $column == '4' ) ? 'clearfix' : ''; ?>">
								<?php
								echo '<span class="counter-icon"> <i class="fa ' . esc_html( $icon ) . '"></i> </span>';
								if ( $fact_num ) {
									echo '<span class="counter">' . $fact_num . '</span>';
								}
								echo '<span class="counter-text">' . esc_html( $fact ) . '</span>';
								?>
							</div>
						<?php endif;
					}
					?>
				</div>
			</div>
		</div>
		<?php
		echo $after_widget;
	}
}
