<?php

/**
 * Class spacious_service_widget.
 */
class spacious_service_widget extends WP_Widget {
	function __construct() {
		$widget_ops  = array(
			'classname'                   => 'widget_service_block',
			'description'                 => esc_html__( 'Display some pages as services. Best for Business Top or Bottom sidebar.', 'spacious' ),
			'customize_selective_refresh' => true,
		);
		$control_ops = array( 'width' => 200, 'height' => 250 );
		parent::__construct( false, $name = esc_html__( 'TG: Services', 'spacious' ), $widget_ops, $control_ops );
	}

	function form( $instance ) {
		for ( $i = 0; $i < 12; $i++ ) {
			$var              = 'page_id' . $i;
			$defaults[ $var ] = '';
		}
		$defaults['image_link']              = '0';
		$defaults['read_more_button_enable'] = '0';
		$defaults['select_column']           = 'services-column-layout-3';
		$defaults['open_in_new_tab']         = '0';
		$instance                            = wp_parse_args( (array) $instance, $defaults );
		for ( $i = 0; $i < 12; $i++ ) {
			$var = 'page_id' . $i;
			$var = absint( $instance[ $var ] );
		}
		$image_link              = $instance['image_link'] ? 'checked="checked"' : '';
		$read_more_button_enable = $instance['read_more_button_enable'] ? 'checked="checked"' : '';
		$open_in_new_tab         = $instance['open_in_new_tab'] ? 'checked="checked"' : '';
		$select_column           = $instance['select_column'];

		?>
		<p>
			<input class="checkbox" type="checkbox" <?php echo $image_link; ?> id="<?php echo $this->get_field_id( 'image_link' ); ?>" name="<?php echo $this->get_field_name( 'image_link' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'image_link' ); ?>"><?php _e( 'Link featured image to their respective page', 'spacious' ); ?></label>
		</p>
		<?php for ( $i = 0; $i < 12; $i++ ) { ?>
			<p>
				<label for="<?php echo $this->get_field_id( key( $defaults ) ); ?>"><?php _e( 'Page', 'spacious' ); ?>
					:</label>
				<?php wp_dropdown_pages( array(
					'show_option_none' => ' ',
					'name'             => $this->get_field_name( key( $defaults ) ),
					'selected'         => $instance[ key( $defaults ) ],
				) ); ?>
			</p>
			<?php
			next( $defaults );// forwards the key of $defaults array
		} ?>
		<p>
			<input class="checkbox" type="checkbox" <?php echo $read_more_button_enable; ?> id="<?php echo $this->get_field_id( 'read_more_button_enable' ); ?>" name="<?php echo $this->get_field_name( 'read_more_button_enable' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'read_more_button_enable' ); ?>"><?php _e( 'Disable the read more button.', 'spacious' ); ?></label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php echo $open_in_new_tab; ?> id="<?php echo $this->get_field_id( 'open_in_new_tab' ); ?>" name="<?php echo $this->get_field_name( 'open_in_new_tab' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'open_in_new_tab' ); ?>"><?php _e( 'Check to open in new tab.', 'spacious' ); ?></label>
		</p>
		<?php _e( 'Select the services column', 'spacious' ); ?>
		<p>
			<select id="<?php echo $this->get_field_id( 'select_column' ); ?>" name="<?php echo $this->get_field_name( 'select_column' ); ?>">
				<option value="services-column-layout-2" <?php if ( $select_column == 'services-column-layout-2' ) {
					echo 'selected="selected"';
				} ?> ><?php _e( 'Two Column', 'spacious' ); ?></option>
				<option value="services-column-layout-3" <?php if ( $select_column == 'services-column-layout-3' ) {
					echo 'selected="selected"';
				} ?> ><?php _e( 'Three Column', 'spacious' ); ?></option>
				<option value="services-column-layout-4" <?php if ( $select_column == 'services-column-layout-4' ) {
					echo 'selected="selected"';
				} ?> ><?php _e( 'Four Column', 'spacious' ); ?></option>
			</select>
		</p>
		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		for ( $i = 0; $i < 12; $i++ ) {
			$var              = 'page_id' . $i;
			$instance[ $var ] = absint( $new_instance[ $var ] );
		}

		$instance['image_link']              = isset( $new_instance['image_link'] ) ? 1 : 0;
		$instance['read_more_button_enable'] = isset( $new_instance['read_more_button_enable'] ) ? 1 : 0;
		$instance['select_column']           = $new_instance['select_column'];
		$instance['open_in_new_tab']         = isset( $new_instance['open_in_new_tab'] ) ? 1 : 0;

		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );

		global $post;
		$image_link              = ! empty( $instance['image_link'] ) ? 'true' : 'false';
		$read_more_button_enable = ! empty( $instance['read_more_button_enable'] ) ? 'true' : 'false';
		$open_in_new_tab         = ! empty( $instance['open_in_new_tab'] ) ? 'true' : 'false';
		$select_column           = isset( $instance['select_column'] ) ? $instance['select_column'] : 'services-column-layout-3';
		$page_array              = array();
		for ( $i = 0; $i < 12; $i++ ) {
			$var     = 'page_id' . $i;
			$page_id = isset( $instance[ $var ] ) ? $instance[ $var ] : '';

			if ( ! empty( $page_id ) ) {
				array_push( $page_array, $page_id );
			}// Push the page id in the array
		}
		if ( ! empty( $page_array ) ) {
			$get_featured_pages = new WP_Query( array(
				'posts_per_page' => -1,
				'post_type'      => array( 'page' ),
				'post__in'       => $page_array,
				'orderby'        => 'post__in',
			) );
			echo $before_widget; ?>
			<?php
			$j = 1;
			while ( $get_featured_pages->have_posts() ):$get_featured_pages->the_post();
				$page_title    = get_the_title();
				$service_class = '';
				if ( $select_column == 'services-column-layout-2' ) :
					if ( $j % 2 == 0 ) {
						$service_class = 'tg-one-half tg-one-half-last';
					} else {
						$service_class = 'tg-one-half tg-after-three-blocks-clearfix';
					}
				elseif ( $select_column == 'services-column-layout-3' ) :
					if ( $j % 2 == 1 && $j > 1 ) {
						$service_class = "tg-one-third";
					} elseif ( $j % 3 == 1 && $j > 1 ) {
						$service_class = "tg-one-third tg-after-three-blocks-clearfix";
					} else {
						$service_class = "tg-one-third";
					}
				elseif ( $select_column == 'services-column-layout-4' ) :
					if ( $j % 4 == 1 ) {
						$service_class = "tg-one-fourth tg-column-1";
					} elseif ( $j % 5 == 1 || $j == 2 ) {
						$service_class = 'tg-one-fourth tg-column-2';
					} elseif ( $j % 6 == 1 || $j == 3 ) {
						$service_class = 'tg-one-fourth tg-after-two-blocks-clearfix tg-column-3';
					} elseif ( $j % 7 == 1 || $j == 4 ) {
						$service_class = 'tg-one-fourth tg-one-fourth-last tg-column-4';
					}
				endif;

				?>
				<div class="<?php echo $service_class; ?>">
					<?php
					$new_tab = '';
					if ( $open_in_new_tab == 'true' ) {
						$new_tab = 'target="_blank"';
					}
					?>
					<?php
					if ( has_post_thumbnail() ) {
						$title_attribute = get_the_title( $post->ID );
						$thumb_id  = get_post_thumbnail_id( get_the_ID() );
						$img_altr  = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true );
						$img_alt   = ! empty( $img_altr ) ? $img_altr : $title_attribute;
						if ( $image_link == 'true' ) {
							echo '<div class="service-image"><a title="' . get_the_title() . '" href="' . get_permalink() . '"' . esc_attr( $new_tab ) . '>' . get_the_post_thumbnail( $post->ID, 'featured', array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $img_alt ) ) ) . '</a></div>';
						} else {
							echo '<div class="service-image">' . get_the_post_thumbnail( $post->ID, 'featured', array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $img_alt ) ) ) . '</div>';
						}
					}
					?>
					<?php echo $before_title; ?>
					<a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>" <?php echo esc_attr( $new_tab ); ?>><?php echo $page_title; ?></a><?php echo $after_title; ?>
					<?php the_excerpt(); ?>
					<?php if ( $read_more_button_enable == "false" ) { ?>
						<div class="more-link-wrap">
							<a class="more-link" title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>" <?php echo esc_attr( $new_tab ); ?>><?php echo spacious_options( 'spacious_read_more_text', __( 'Read more', 'spacious' ) ); ?></a>
						</div>
					<?php } ?>
				</div>
				<?php $j++; ?>
			<?php endwhile;
			// Reset Post Data
			wp_reset_postdata();
			?>
			<?php
			echo $after_widget;
		}
	}
}
