<?php

/**
 * Class spacious_featured_single_page_widget.
 */
class spacious_featured_single_page_widget extends WP_Widget {
	function __construct() {
		$widget_ops  = array(
			'classname'                   => 'widget_featured_single_post',
			'description'                 => esc_html__( 'Display Featured Single Page', 'spacious' ),
			'customize_selective_refresh' => true,
		);
		$control_ops = array( 'width' => 200, 'height' => 250 );
		parent::__construct( false, $name = esc_html__( 'TG: Featured Single Page', 'spacious' ), $widget_ops, $control_ops );
	}

	function form( $instance ) {
		$instance                = wp_parse_args( (array) $instance, array(
			'page_id'                 => '',
			'title'                   => '',
			'disable_feature_image'   => 0,
			'image_position'          => 'above',
			'disable_three_dots'      => 0,
			'read_more_button_enable' => 0,
			'enable_permalink_image'  => 0,
		) );
		$title                   = esc_attr( $instance['title'] );
		$page_id                 = absint( $instance['page_id'] );
		$enable_permalink_image  = $instance['enable_permalink_image'] ? 'checked="checked"' : '';
		$disable_feature_image   = $instance['disable_feature_image'] ? 'checked="checked"' : '';
		$image_position          = $instance['image_position'];
		$disable_three_dots      = $instance['disable_three_dots'] ? 'checked="checked"' : '';
		$read_more_button_enable = $instance['read_more_button_enable'] ? 'checked="checked"' : '';
		_e( 'Suitable for Home Top Sidebar, Home Bottom Left Sidebar and Side Sidbar.', 'spacious' );
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'spacious' ); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p><?php _e( 'Displays the title of the Page if title input is empty.', 'spacious' ); ?></p>

		<p>
			<label for="<?php echo $this->get_field_id( 'page_id' ); ?>"><?php _e( 'Page', 'spacious' ); ?>:</label>
			<?php wp_dropdown_pages( array(
				'name'     => $this->get_field_name( 'page_id' ),
				'selected' => $instance['page_id'],
			) ); ?>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php echo $disable_feature_image; ?> id="<?php echo $this->get_field_id( 'disable_feature_image' ); ?>" name="<?php echo $this->get_field_name( 'disable_feature_image' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'disable_feature_image' ); ?>"><?php _e( 'Remove Featured image', 'spacious' ); ?></label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php echo $enable_permalink_image; ?> id="<?php echo $this->get_field_id( 'enable_permalink_image' ); ?>" name="<?php echo $this->get_field_name( 'enable_permalink_image' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'enable_permalink_image' ); ?>"><?php _e( 'Link the featured image to the respective page.', 'spacious' ); ?></label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php echo $disable_three_dots; ?> id="<?php echo $this->get_field_id( 'disable_three_dots' ); ?>" name="<?php echo $this->get_field_name( 'disable_three_dots' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'disable_three_dots' ); ?>"><?php _e( 'Remove the dots at the end of content', 'spacious' ); ?></label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php echo $read_more_button_enable; ?> id="<?php echo $this->get_field_id( 'read_more_button_enable' ); ?>" name="<?php echo $this->get_field_name( 'read_more_button_enable' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'read_more_button_enable' ); ?>"><?php _e( 'Disable the read more button.', 'spacious' ); ?></label>
		</p>

		<?php if ( $image_position == 'above' ) { ?>
			<p>
				<input type="radio" id="<?php echo $this->get_field_id( 'image_position' ); ?>" name="<?php echo $this->get_field_name( 'image_position' ); ?>" value="above" style="" checked /><?php _e( 'Show Image Before Title', 'spacious' ); ?>
				<br />
				<input type="radio" id="<?php echo $this->get_field_id( 'image_position' ); ?>" name="<?php echo $this->get_field_name( 'image_position' ); ?>" value="below" style="" /><?php _e( 'Show Image After Title', 'spacious' ); ?>
				<br />
			</p>
		<?php } else { ?>
			<p>
				<input type="radio" id="<?php echo $this->get_field_id( 'image_position' ); ?>" name="<?php echo $this->get_field_name( 'image_position' ); ?>" value="above" style="" /><?php _e( 'Show Image Before Title', 'spacious' ); ?>
				<br />
				<input type="radio" id="<?php echo $this->get_field_id( 'image_position' ); ?>" name="<?php echo $this->get_field_name( 'image_position' ); ?>" value="below" style="" checked /><?php _e( 'Show Image After Title', 'spacious' ); ?>
				<br />
			</p>
		<?php } ?>

		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance                            = $old_instance;
		$instance['title']                   = strip_tags( $new_instance['title'] );
		$instance['page_id']                 = absint( $new_instance['page_id'] );
		$instance['disable_feature_image']   = isset( $new_instance['disable_feature_image'] ) ? 1 : 0;
		$instance['enable_permalink_image']  = isset( $new_instance['enable_permalink_image'] ) ? 1 : 0;
		$instance['image_position']          = $new_instance['image_position'];
		$instance['disable_three_dots']      = isset( $new_instance['disable_three_dots'] ) ? 1 : 0;
		$instance['read_more_button_enable'] = isset( $new_instance['read_more_button_enable'] ) ? 1 : 0;

		return $instance;
	}

	function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );
		global $post;
		$title                   = apply_filters( 'widget_title', isset( $instance['title'] ) ? $instance['title'] : '' );
		$page_id                 = isset( $instance['page_id'] ) ? $instance['page_id'] : '';
		$disable_feature_image   = ! empty( $instance['disable_feature_image'] ) ? 'true' : 'false';
		$enable_permalink_image  = ! empty( $instance['enable_permalink_image'] ) ? 'true' : 'false';
		$disable_three_dots      = ! empty( $instance['disable_three_dots'] ) ? 'true' : 'false';
		$read_more_button_enable = ! empty( $instance['read_more_button_enable'] ) ? 'true' : 'false';
		$image_position          = isset( $instance['image_position'] ) ? $instance['image_position'] : 'above';

		if ( $page_id ) {
			$output = '';
			$the_query = new WP_Query( 'page_id=' . $page_id );
			while ( $the_query->have_posts() ):$the_query->the_post();
				$page_name = get_the_title();
				$thumb_id  = get_post_thumbnail_id( get_the_ID() );
				$img_altr  = get_post_meta( $thumb_id, '_wp_attachment_image_alt', true );
				$img_alt   = ! empty( $img_altr ) ? $img_altr : $page_name;

				$output .= $before_widget;
				if ( $image_position == "below" ) {
					if ( $title ): $output .= $before_title . '<a href="' . get_permalink() . '" title="' . $title . '">' . $title . '</a>' . $after_title;
					else: $output .= $before_title . '<a href="' . get_permalink() . '" title="' . $page_name . '">' . $page_name . '</a>' . $after_title;
					endif;
				}
				if ( has_post_thumbnail() && $disable_feature_image != "true" ) {
					if ( $enable_permalink_image == "false" ) {
						$output .= '<div class="service-image">' . get_the_post_thumbnail( $post->ID, 'featured', array(
								'title' => esc_attr( $page_name ),
								'alt'   => esc_attr( $img_alt ),
							) ) . '</div>';
					} else {
						$output .= '<div class="service-image">' . '<a href="' . get_the_permalink() . '" title="' . get_the_title() . '">' . get_the_post_thumbnail( $post->ID, 'featured', array(
								'title' => esc_attr( $page_name ),
								'alt'   => esc_attr( $img_alt ),
							) ) . '</a></div>';
					}
				}

				if ( $image_position == "above" ) {
					if ( $title ): $output .= $before_title . '<a href="' . get_permalink() . '" title="' . $title . '">' . $title . '</a>' . $after_title;
					else: $output .= $before_title . '<a href="' . get_permalink() . '" title="' . $page_name . '">' . $page_name . '</a>' . $after_title;
					endif;
				}
				$three_dots = '...';
				if ( $disable_three_dots == "true" ) {
					$three_dots = '';
				}
				$output .= '<p>' . get_the_excerpt() . $three_dots . '</p>';
				if ( $read_more_button_enable == "false" ) {
					$output .= '<a class="read-more" href="' . get_permalink() . '">' . spacious_options( 'spacious_read_more_text', __( 'Read more', 'spacious' ) ) . '</a>';
				}
				$output .= $after_widget;
			endwhile;
			// Reset Post Data
			wp_reset_postdata();
			echo $output;
		}

	}
}
